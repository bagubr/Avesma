<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FishPriceResource extends JsonResource
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
            "id" => $this->id,
            "fish_species_id" => $this->fish_species_id,
            "fish_species_name" => $this->fish_species?->name,
            "region_id" => $this->region_id,
            "region_name" => $this->region?->name,
            "price" => $this->price,
            "is_verified" => $this->is_verified,
            "reported_at" => $this->reported_at
        ];
    }
}
