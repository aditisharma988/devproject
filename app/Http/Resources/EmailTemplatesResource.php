<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailTemplatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [

            'template_subject' => $this->template_subject,
            'template_description' => $this->template_description,
            'template_images' => $this->template_images,
            'template_category' => $this->template_category,
            'template_subcategory' => $this->template_subcategory,
            'template_body' => $this->template_body,
            'template_name' => $this->template_name,
            'filename' => $this->filename,

        ];
    }
}
