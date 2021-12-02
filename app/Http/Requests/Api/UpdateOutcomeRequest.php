<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateOutcomeRequest extends ApiRequest
{
    public function rules(Request $request)
    {
        return [
            'pond_detail_id' => 'required|exists:pond_details,id',
            'reported_at' => [
                'required',
                'date',
                Rule::unique('outcomes', 'reported_at')
                    ->where('outcome_category_id', 2)
                    ->where('pond_detail_id', $request->pond_detail_id)
                    ->ignore($this->outcome->id),
            ],
            'outcome_category_id' => 'required|exists:outcome_categories,id',

            'data.*.outcome_setting_id' => 'required|numeric',
            'data.*.price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'reported_at.unique' => 'Tanggal Tersebut Sudah Anda Gunakan',
        ];
    }
}
