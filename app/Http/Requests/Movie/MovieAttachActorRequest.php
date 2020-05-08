<?php

namespace App\Http\Requests\Movie;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\MoviesActorRoleTypes;

class MovieAttachActorRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required',
            'role_type' => 'required|in:'.MoviesActorRoleTypes::stringify(),

        ];
    }
}
