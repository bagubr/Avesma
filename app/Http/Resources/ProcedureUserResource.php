<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureUserResource extends JsonResource
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
            "user_id" =>  $this->user_id,
            "user_name" =>  $this->user?->name,
            "pond_detail_id" => $this->pond_detail_id,
            "total_score" => $this->form_procedure_detail_input->sum('score'),
            "reported_at" => $this->reported_at,
        ];
    }
}
