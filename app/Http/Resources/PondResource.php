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
            'name' => $this->name,
            'area' => $this->area,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
            "status" => $this->status,
            "pond_detail" => $this->pond_detail,
        ];
    }
}
