<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Device::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|url|in:http,https',
            'label' => 'required|string',
            'template' => 'required|uuid',
            'lines' => 'required|array|max:8',
            'lines.*.line' => 'required|integer|min:1|max:18',
            'lines.*.server_address' => 'required|url',
            'lines.*.label' => 'required|string',
            'lines.*.display_name' => 'required|string',
            'lines.*.user_id' => 'required|string',
            'lines.*.auth_id' => 'required|string',
            'lines.*.password' => 'required|string',
            'lines.*.port_no' => 'required|integer',
            'lines.*.transport' => 'required|in:TCP,UDP,TLS',
            'lines.*.register_expires' => 'required|integer',
            // 'lines.*.shared_line' => 'required|boolean',
            'lines.*.enabled' => 'required|boolean',
            'enabled' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $device = Device::create($request->all());

        return response()->json($device, 201);
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return $device;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'address' =>'url'|'in:http,https',
            'label' =>'string',
            'template' =>'uuid',
            'lines' => 'array|max:8',
            'lines.*.line' => 'nullable|integer|min:1|max:18',
            'lines.*.server_address' => 'nullable|url',
            'lines.*.label' => 'nullable|string',
            'lines.*.display_name' => 'nullable|string',
            'lines.*.user_id' => 'nullable|string',
            'lines.*.auth_id' => 'nullable|string',
            'lines.*.password' => 'nullable|string',
            'lines.*.port_no' => 'nullable|integer',
            'lines.*.transport' => 'nullable|in:TCP,UDP,TLS',
            'lines.*.register_expires' => 'nullable|integer',
            'lines.*.shared_line' => 'nullable|boolean',
            'lines.*.enabled' => 'nullable|boolean',
            'enabled' =>'boolean',
            'description' =>'nullable|string',
        ]);

        $device->update($request->all());
        return response()->json($device,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json(null,204);
    }
}
