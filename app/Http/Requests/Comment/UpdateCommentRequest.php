<?php

namespace App\Http\Requests\Comment;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class UpdateCommentRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required',
            'rate' => 'nullable|integer',

        ];
    }
}
