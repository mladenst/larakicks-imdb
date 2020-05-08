<?php

namespace App\Http\Requests\UserSession;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class BulkUserSessionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.*.ip_address' => 'required',
            'data.*.browser' => 'required',
            'data.*.country' => 'required',
            'data.*.country_code' => 'required',
            'data.*.zip_code' => 'required',
            'data.*.city' => 'required',

        ];
    }
}
