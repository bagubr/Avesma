<?php

namespace App\Http\Requests;


class UpdatePondDetailProductRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
