<?php

namespace App\Http\Requests\UserSession;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class BulkDeleteUserSessionRequest extends ApiRequest
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
            'data.*.id' => 'required',

        ];
    }
}
