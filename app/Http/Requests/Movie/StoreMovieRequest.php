<?php

namespace App\Http\Requests\Movie;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\MovieGenres;

class StoreMovieRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'genre' => 'required|in:'.MovieGenres::stringify(),
            'release_date' => 'nullable|date',

        ];
    }
}
