<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRegisterFormRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(empty(request()->user())) {
            return [
                'name'=>'required|string',
                'email'=>'required|unique:users,email|email:rfc,dns',
                'phone'=>'required|string|unique:users,phone',
                'gender'=>'required|string',
                'birth_date'=>'sometimes|nullable|date',
                'address'=>'sometimes|nullable|max:40'
            ];
        }
        return [
            'name'=>'required|string',
            'email'=>['required','email:rfc,dns', Rule::unique('users', 'email')->ignore(request()->user()->id)],
            'phone'=>['required','string', Rule::unique('users', 'phone')->ignore(request()->user()->id)],
            'gender'=>'required|string',
            'birth_date'=>'sometimes|nullable|date',
            'address'=>'sometimes|nullable|max:40',
            'pokdakan_id'=>'sometimes|nullable|numeric|exists:pokdakans,id',
            'region_id'=>'sometimes|nullable|numeric|exists:regions,id'
        ];
    }
}
