<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Validator;

class OutcomeCreateRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pond_detail_id' => 'required|exists:pond_details,id',
            'reported_at' => 'required|date',
            // 'data.*.outcome_setting_id'=>'required|numeric',
            // 'data.*.name'=>'sometimes|nullable',
            // 'data.*.total_price'=>'required|numeric',
        ];
    }
}
