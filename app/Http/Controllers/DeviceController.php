<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\DeviceLineResource;


class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('lines')->get();
        return DeviceResource::collection($devices);
    }
    
     public function store(Request $request)
     {
         $input = $request->validate([
             'device_address' => ['required', 'mac_address'],
             'device_label' => ['required', 'string', 'max:40'],
             'device_template' => ['required', 'uuid'],
             'device_enabled' => ['required', 'boolean'],
             'device_description' => ['nullable', 'string', 'max:255'],
             'lines' => ['required', 'array', 'max:8'],
             'lines.*.line_number' => ['required', 'integer', 'min:1', 'max:18'],
             'lines.*.server_address' => ['required', 'ipv4'],
             'lines.*.label' => ['required', 'string'],
             'lines.*.display_name' => ['required', 'string' ,'max:40'],
             'lines.*.user_id' => ['required', 'string'],
             'lines.*.auth_id' => ['required', 'string'],
             'lines.*.password' =>  ['required', 'string'],
             'lines.*.sip_port' => ['required', 'integer','min:1','max:65535'],
             'lines.*.sip_transport' => ['required', Rule::in(['TCP', 'UDP', 'TLS'])],
             'lines.*.register_expires' => ['required', 'integer','min:30'],
             'lines.*.shared_line' => ['required', 'boolean'],
             'lines.*.enabled' => ['required', 'boolean'],
         ]);
     
         $input['device_uuid'] = Str::uuid();

         $input['device_line_uuid'] = Str::uuid();
     
         $device = Device::create($input);

         foreach ($input['lines'] as $lineData){
             $line = $device->lines()->create($lineData);
         }
     
         return response()->json([
            'message' => trans('messages.DEVICEDATA_STORED'),
        ], 200);
     }

     public function show(string $deviceId): JsonResponse
     {
         $device = Device::find($deviceId);
     
         if (!$device) {
             return response()->json([
                 'error' => trans('messages.NOT_FOUND')], 404);
         }
     
         return response()->json([
             'message' => trans('DEVICEDATA_FETCHED_SUCCESSFULLY'),
             'data' => new DeviceResource($device),
         ], 200);
     }
    

    public function update(Request $request, string $deviceId)
    {
        $device = Device::find($deviceId);
    
        if (!$device) {
            return response()->json(['error' => trans('DEVICEDATA_NOT_FOUND')], 404);
        }
    
        $input = $request->validate([
            'device_address' => ['required', 'mac_address'],
            'device_label' => ['required', 'string', 'max:40'],
            'device_template' => ['required', 'uuid'],
            'device_enabled' => ['required', 'boolean'],
            'device_description' => ['nullable', 'string', 'max:255'],
            'lines' => ['nullable', 'array', 'max:8'],
            'lines.*.line_number' => ['required_with:lines', 'integer', 'min:1', 'max:18','distinct'],
            'lines.*.server_address' => ['required_with:lines', 'ipv4'],
            'lines.*.label' => ['required_with:lines', 'string'],
            'lines.*.display_name' => ['required_with:lines', 'string', 'max:40'],
            'lines.*.user_id' => ['required_with:lines', 'string'],
            'lines.*.auth_id' => ['required_with:lines', 'string'],
            'lines.*.password' => ['required_with:lines', 'string'],
            'lines.*.sip_port' => ['required_with:lines', 'integer', 'min:1', 'max:65535'],
            'lines.*.sip_transport' => ['required_with:lines', Rule::in(['TCP', 'UDP', 'TLS'])],
            'lines.*.register_expires' => ['required_with:lines', 'integer', 'min:30'],
            'lines.*.shared_line' => ['required_with:lines', 'boolean'],
            'lines.*.enabled' => ['required_with:lines', 'boolean'],
        ]);
    
        $device->fill($input);
    
        $distinctLineNumbers = collect($input['lines'])->pluck('line_number')->toArray();
        $device->lines()->whereNotIn('line_number', $distinctLineNumbers)->delete();

        if (isset($input['lines'])) {
            $linesData = $input['lines'];

            foreach ($linesData as $lineData) {
                $line = $device->lines()->updateOrCreate(['line_number' => $lineData['line_number']], $lineData);
            }
       }
        $device->save();
    
        return response()->json(['message' => trans('DEVICEDATA_UPDATED_SUCCESSFULLY'),
         'data' => new DeviceResource($device),
         'lines' => DeviceLineResource::collection($device->lines),], 200);
    }
               
               
    public function destroy(Device $device,string $deviceId)
    {
       $device = Device::find($deviceId);

        $device->delete();
    return response()->json([ 
        'message' => trans('DEVICEDATA_DELETED_SUCCESSFULLY')], 200);
     }}
