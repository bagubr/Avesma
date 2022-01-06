<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UploadUserInformationRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik'=>'required|string|max:16|min:16',
            'ktp_photo'=>'required:mimetypes:image/*',
            'ktp_selfie_photo'=>'required|mimetypes:image/*'
        ];
    }
}
