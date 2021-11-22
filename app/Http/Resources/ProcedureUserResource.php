<?php

namespace App\Http\Resources;

use App\Models\FormProcedureFormula;
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
            "form_procedure_id" => $this->form_procedure_id,
            "form_procedure_name" => $this->form_procedure?->fish_and_procedure,
            "total_score" => $this->form_procedure_detail_input->sum('score'),
            "parameter" => $this->getFormula($this->form_procedure_id, $this->form_procedure_detail_input->sum('score'))->note,
            "reported_at" => $this->reported_at,
            "procedure_details" => ProcedureDetailResource::collection($this->form_procedure_detail_input)
        ];
    }

    public function getFormula($id, $score)
    {
        $formula = FormProcedureFormula::where('form_procedure_id', $id)->where('min_range', '<=', $score)
            ->where('max_range', '>=', $score)->first();
        return $formula;
    }
}
