<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormProcedureInputUserStatisticResource extends JsonResource
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
            "user_id" => $this->user_id,
            "pond_detail_id" => $this->pond_detail_id,
            "reported_at"=> $this->reported_at,
            "form_procedure_id"=> $this->form_procedure_id,
            "form_procedure_name"=> $this->form_procedure_name,
            "form_procedure_formula"=> $this->form_procedure_formula,
            "total_score"=> $this->total_score,
        ];
    }
}
