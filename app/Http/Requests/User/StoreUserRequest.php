<?php

namespace App\Http\Requests\User;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Support\Enum\UserStatuses;

class StoreUserRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $profileRequest = new StoreProfileRequest;
        
        return array_merge(
            [
            'email' => "required|email|max:255|unique:users",
            'password' => "required|confirmed|min:6",

        ],
            $profileRequest->rules()
        );
    }
}
