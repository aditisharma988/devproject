<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'device_uuid' => $this->device_uuid,
            'device_address' => $this->device_address,
            'device_label' => $this->device_label,
            'device_model' => $this->device_model,
            'device_enabled' => $this->device_enabled,
            'device_template' => $this->device_template,
            'device_description' => $this->device_description,
            'lines' => DeviceLineResource::collection($this->lines),
        ];
    }
}
