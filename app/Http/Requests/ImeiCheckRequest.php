<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImeiCheckRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'=>'required|string',
            'imei'=>'required|string'
        ];
    }
}
