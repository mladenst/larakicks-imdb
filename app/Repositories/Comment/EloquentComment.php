<?php

namespace App\Repositories\Comment;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Comment;

class EloquentComment extends EloquentRepo implements ICommentRepo
{
    public function __construct()
    {
    }

    /**
     * Configure the Model
     * */
    public function model()
    {
        return new Comment;
    }
}
