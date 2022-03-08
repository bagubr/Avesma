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
            'cycle_id' => 'required|exists:cycles,id',
            'reported_at' => [
                'required',
                'date',
                Rule::unique('outcomes', 'reported_at')
                    ->where('outcome_category_id', 2)
                    ->where('cycle_id', $request->cycle_id)
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
            'reported_at.unique' => 'Tanggal Tersebut Sudah Anda Gunakan Pada Data Lain',
        ];
    }
}
