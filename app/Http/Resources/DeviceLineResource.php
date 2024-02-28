<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
        {
            return [
                'device_line_uuid' => $this->device_line_uuid,
                'domain_uuid' => $this->domain_uuid,
                'device_uuid' => $this->device_uuid,
                'line_number' => $this->line_number,
                'server_address' => $this->server_address,
                'label' => $this->label,
                'display_name' => $this->display_name,
                'user_id' => $this->user_id,
                'auth_id' => $this->auth_id,
                'password' => $this->password,
                'sip_port' => $this->sip_port,
                'sip_transport' => $this->sip_transport,
                'register_expires' => $this->register_expires,
                'shared_line' => $this->shared_line,
                'enabled' => $this->enabled,
            ];
        }
    }
    