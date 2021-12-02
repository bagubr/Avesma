<?php

namespace App\Http\Resources;

use App\Models\FishSpecies;
use App\Models\Pond;
use Illuminate\Http\Resources\Json\JsonResource;

class FishSpeciesResource extends JsonResource
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
            "fish_category_id" => $this->fish_category_id,
            "pond_details_count" => $this->getCount($request->user()->id, $this->id),
            "name" => $this->name,
            "image" => $this->image,
            "image_url" => $this->image_url,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
    public function getCount($user_id, $id)
    {
        $count = Pond::where('user_id', $user_id)->where('status', '!=', Pond::STATUS3)
            ->whereHas('pond_detail', function ($q) use ($id) {
                $q->where('fish_species_id', $id);
            })->count();
        return $count;
    }
}
