<?php

namespace App\Http\Requests\Comment;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class BulkCommentRequest extends ApiRequest
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
            'data.*.text' => 'required',
            'data.*.rate' => 'nullable|integer',

        ];
    }
}
