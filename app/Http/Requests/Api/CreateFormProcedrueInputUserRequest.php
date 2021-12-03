<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateFormProcedrueInputUserRequest extends ApiRequest
{
    public function rules(Request $request)
    {
        return [
            'pond_detail_id' => 'required|exists:pond_details,id',
            'form_procedure_id' => 'required|exists:form_procedures,id',
            'reported_at' => [
                'required',
                'date',
                Rule::unique('form_procedure_input_users')->where('form_procedure_id', $request->form_procedure_id)
                    ->where('pond_detail_id', $request->pond_detail_id),
            ],
        ];
    }
}
