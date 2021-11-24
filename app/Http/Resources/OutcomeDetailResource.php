<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OutcomeDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'outcome_id' => $this->outcome_id,
            "outcome_setting_id" => $this->outcome_setting_id,
            "outcome_setting" => new OutcomeSettingResource($this->outcome_setting),
            "price" => $this->price,
        ];
    }
}
