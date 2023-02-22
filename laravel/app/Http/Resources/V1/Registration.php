<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Registration extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->reg_id,
            'event' => new Event($this->event),
            'status' => $this->status->name,
            'createdAt' => $this->created_at,
        ];
    }
}
