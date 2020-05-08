<?php

namespace App\Http\Requests\Actor;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreActorRequest extends ApiRequest
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
