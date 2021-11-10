<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateIncomeRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pond_detail_id'=>'required|numeric|exists:pond_details,id',
            'reported_at'=>'required|date', 

            'data.*.pond_detail_product_id'=>'required|numeric',
            'data.*.weight'=>'required|numeric',
            'data.*.price'=>'required|numeric',
            'data.*.total_price'=>'required|numeric',
        ];
    }
}
