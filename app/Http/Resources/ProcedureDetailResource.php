<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureDetailResource extends JsonResource
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
            "form_procedure_detail_id" => $this->form_procedure_detail_id,
            "form_procedure_detail_name" => $this->form_procedure_detail->name,
            "form_procedure_detail_formula_id" => $this->form_procedure_detail_formula_id,
            "form_procedure_detail_formula_parameter" => $this->form_procedure_detail_formula->parameter,
            "score" => $this->score,
            "form_procedure_input_user_id" => $this->form_procedure_input_user_id
        ];
    }
}
