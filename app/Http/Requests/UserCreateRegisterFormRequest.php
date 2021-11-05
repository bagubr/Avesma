<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRegisterFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'email'=>'required|unique:users,email|email:rfc,dns',
            'phone'=>'required|string|unique:users,phone',
            'gender'=>'required|string',
            'birth_date'=>'sometimes|nullable|date',
            'address'=>'sometimes|nullable|max:40'
        ];
    }
}
