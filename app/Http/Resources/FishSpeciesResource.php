<?php

namespace App\Http\Resources;

use App\Models\FishSpecies;
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
        $count = FishSpecies::whereHas('pond_details.pond', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->where('id', $id)->count();
        return $count;
    }
}
