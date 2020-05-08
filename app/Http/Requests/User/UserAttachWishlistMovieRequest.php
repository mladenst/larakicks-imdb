<?php

namespace App\Http\Requests\User;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class UserAttachWishlistMovieRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'note' => 'nullable',

        ];
    }
}
