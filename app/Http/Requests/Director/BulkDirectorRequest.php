<?php

namespace App\Http\Requests\Director;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class BulkDirectorRequest extends ApiRequest
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
            'data.*.firstname' => 'required',
            'data.*.lastname' => 'required',
            'data.*.dob' => 'nullable|date',

        ];
    }
}
