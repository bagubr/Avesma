<?php

namespace App\Http\Requests;


class UpdateStatusPondHarvestRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'status' => 'required'
        ];
    }
}
