<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PondCreateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
            'area'=>'required|numeric',
            'name'=>'required',
            'address'=>'sometimes|nullable|string',
            'fish_species_id'=>'required|numeric',
            'seed_count'=>'required|numeric',
            'seed_size'=>'nullable|sometimes|numeric',
            'feed_type'=>'nullable|sometimes|string'
        ];
    }
}
