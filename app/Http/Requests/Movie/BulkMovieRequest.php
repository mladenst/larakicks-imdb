<?php

namespace App\Http\Requests\Movie;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\MovieGenres;

class BulkMovieRequest extends ApiRequest
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
            'data.*.name' => 'required',
            'data.*.genre' => 'required|in:'.MovieGenres::stringify(),
            'data.*.release_date' => 'nullable|date',

        ];
    }
}
