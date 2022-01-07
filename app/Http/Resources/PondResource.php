<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PondResource extends JsonResource
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
            "user_id" =>  $this->user->id,
            'name' => $this->name ?? "",
            'area' => $this->area ?? "",
            'description' => $this->description ?? "",
            'latitude' => $this->latitude ?? "",
            'longitude' => $this->longitude ?? "",
            'address' => $this->address ?? "",
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "status" => $this->status ?? "",
            "pond_detail" => new PondDetailResouce($this->pond_detail),
            "region_name" => $this->region_name,
        ];
    }
}
