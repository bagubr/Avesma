<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PondAndPondDetailResource extends JsonResource
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
            'pond_name' => $this->pond_detail->pond_name,
            'pond_spesies' => $this->pond_detail->pond_spesies,
            'area' => $this->area,
            'seed_count' => $this->pond_detail->seed_count,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
