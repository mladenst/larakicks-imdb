<?php

namespace App\Http\Requests\UserSession;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreUserSessionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ip_address' => 'required',
            'browser' => 'required',
            'country' => 'required',
            'country_code' => 'required',
            'zip_code' => 'required',
            'city' => 'required',

        ];
    }
}
