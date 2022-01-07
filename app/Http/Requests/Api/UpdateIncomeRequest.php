<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateIncomeRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'pond_detail_id' => 'required|numeric|exists:pond_details,id',
            'reported_at' => [
                'required', 'date',
                Rule::unique('incomes','reported_at')->where('pond_detail_id', $request->pond_detail_id)
                    ->ignore($this->income->id),
            ],

            'data.*.pond_detail_product_id' => 'required|numeric',
            'data.*.weight' => 'required|numeric',
            'data.*.price' => 'required|numeric',
            'data.*.total_price' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'reported_at.unique' => 'Tanggal Tersebut Sudah Anda Gunakan Pada Data Lain',
        ];
    }
}
