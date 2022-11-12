<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
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
            'city' => $this->city,
            'province' => $this->province,
            'country' => $this->country->name,
            'image' => $this->image,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
