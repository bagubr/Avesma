<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormProcedureStatisticResource extends JsonResource
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
            "procedure_id" => $this->procedure_id,
            "fish_species_id" => $this->fish_species_id,
            "procedure_name" => $this->procedure_name,
            "fish_species_name" => $this->fish_species_name,
            "fish_and_procedure" => $this->fish_and_procedure,
            "form_procedure_input_users" =>  FormProcedureInputUserStatisticResource::collection($this->getInputUser($this->form_procedure_input_users))
        ];
    }
    public function getInputUser($form_procedure_input_users)
    {
        if (is_null($form_procedure_input_users)) {
            return [];
        }
        return $form_procedure_input_users;
    }
}
