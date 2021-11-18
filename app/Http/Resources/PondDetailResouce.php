<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PondDetailResouce extends JsonResource
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
            "pond_id" =>  $this->pond_id,
            'fish_species_id' => $this->fish_species_id,
            'seed_count' => $this->seed_count,
            'feed_type' => $this->feed_type,
            'seed_size' => $this->seed_size,
            'pond_name' => $this->pond_name,
            'fish_category' => $this->fish_species?->fish_category?->name ?? '',
            'fish_category_image' => $this->fish_species?->fish_category?->image_url ?? '',
            'spesies_name' => $this->spesies_name,
            'pond_spesies' => $this->pond_spesies,
            'text' => $this->text,
        ];
    }
}
