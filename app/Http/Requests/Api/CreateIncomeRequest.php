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

            'name'=>'required|string',
            'weight'=>'required|numeric',
            'price'=>'required|numeric',
            'total_price'=>'required|numeric',
        ];
    }
}
