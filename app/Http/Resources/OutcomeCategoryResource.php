<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OutcomeCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *ca
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'outcome_settings' => $this->outcome_settings
        ];
    }
}
