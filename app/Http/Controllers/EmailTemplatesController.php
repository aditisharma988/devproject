<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmailTemplatesResource;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = EmailTemplate::all();
        return $this->success(EmailTemplatesResource::collection($mails), Response::HTTP_OK, trans('SUCCESS'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(storage_path('app\public\images'));

        $input = $request->validate([
            'template_subject' => ['required', 'max:50'],
            'template_description' => ['nullable', 'max:255', 'string'],
            'template_category' => ['required', 'max:40', 'string'],
            'template_subcategory' => ['required', 'max:40', 'string'],
            'template_name' => ['required', 'max:40', 'string'],
            'template_body' => ['required', 'string'],
            'template_images' => ['nullable', 'array'],
            'template_images.*' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif'],
        ]);
        if (isset($input['template_images'])) {
            foreach ($input['template_images'] as $file) {
                $filename = $file->getClientOriginalName();
                $filenames[] = $filename;
                Storage::disk('images')->put($filename, file_get_contents($file));
            }
        }
        $input['template_images'] = $filenames;
        EmailTemplate::create($input);
        return $this->success([], Response::HTTP_OK, trans('EMAIL_TEMPLATE_CREATED'));
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $mail = EmailTemplate::find($id);
        return $this->success(new EmailTemplatesResource($mail), Response::HTTP_OK, trans('SUCCESS'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        {

            $input = $this->validate($request, [
                'template_subject' => ['required', 'max:50'],
                'template_description' => ['nullable', 'max:255', 'string'],
                'template_category' => ['required', 'max:40', 'string'],
                'template_subcategory' => ['required', 'max:40', 'string'],
                'template_name' => ['required', 'max:40', 'string'],
                'template_body' => ['required', 'string'],
                'template_image' => ['nullable', 'json'],
            ]);
            $mail = EmailTemplate::find($id);
            $mail->update($input);
            return $this->success([], Response::HTTP_OK, trans('EMAIL_TEMPLATE_UPDATED'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $mail = EmailTemplate::find($id);
        $mail->delete();

        return $this->success([], Response::HTTP_OK, trans('EMAIL_TEMPLATE_DELETED'));
    }

}
