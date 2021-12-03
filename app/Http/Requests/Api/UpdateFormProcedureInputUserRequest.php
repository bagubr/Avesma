<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormProcedureInputUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'reported_at' => [
                'required',
                'date',
                Rule::unique('form_procedure_input_users', 'reported_at')
                    ->where('pond_detail_id', $this->form_procedure_input_user->pond_detail_id)
                    ->ignore($this->form_procedure_input_user->id),
            ],
        ];
    }
    public function messages()
    {
        return [
            'reported_at.unique' => 'Tanggal Tersebut Sudah Anda Gunakan Pada Data Lain',
        ];
    }
}
