<?php

namespace App\Http\Resources;

use App\Models\FormProcedure;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureResourceFishSpecies extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image,
            'image_url' => $this->image_url,
            'is_procedure' => $this->is_procedure,
            'form_procedure' => $this->form_procedures->whereIn('fish_species_id', $request->fish_species_id)->first(),
        ];
    }
}
