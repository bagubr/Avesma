<?php

namespace App\Http\Requests\PondDetailProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreatePondDetailProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pond_detail_id' => 'required',
            'name' => 'required'
        ];
    }
}
