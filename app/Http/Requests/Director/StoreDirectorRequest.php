<?php

namespace App\Http\Requests\Director;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreDirectorRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'dob' => 'nullable|date',

        ];
    }
}
