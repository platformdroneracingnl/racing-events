<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'date' => $this->date,
            'maxRegistrations' => $this->max_registrations,
            'location' => $this->location,
            'startRegistration' => $this->start_registration,
            'endRegistration' => $this->end_registration,
            'price' => $this->price,
        ];
    }
}
