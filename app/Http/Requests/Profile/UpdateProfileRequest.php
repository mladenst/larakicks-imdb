<?php

namespace App\Http\Requests\Profile;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class UpdateProfileRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'avatar' => 'nullable|image',

        ];
    }
}
