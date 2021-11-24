<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OutcomeResource extends JsonResource
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
            "pond_detail_id" => $this->pond_detail_id,
            "pond_detail_name" => $this->pond_detail->pond->name,
            "total_nominal" => $this->total_nominal,
            "reported_at" => $this->reported_at,
            "outcome_detail" => OutcomeDetailResource::collection($this->outcome_detail)
        ];
    }
}
