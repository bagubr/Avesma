<?php

namespace App\Http\Requests;


class CreatePondHarvestRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'status' => 'required',
            'pond_detail_id' => 'required|exists:pond_details,id',
            'harvest_at' => 'required|date',
            'weight' => 'required',
            'image' => 'required|image'
        ];
    }
}
