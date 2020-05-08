<?php

namespace App\Repositories\UserSession;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\UserSession;

class EloquentUserSession extends EloquentRepo implements IUserSessionRepo
{
    public function __construct()
    {
    }

    /**
     * Configure the Model
     * */
    public function model()
    {
        return new UserSession;
    }
}
