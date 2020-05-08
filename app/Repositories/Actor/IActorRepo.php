<?php

namespace App\Repositories\Actor;

use Dinkara\RepoBuilder\Repositories\IRepo;
use App\Models\Actor;
use App\Models\Movie;

/**
 * Interface ActorRepository
 * @package App\Repositories\Actor
 */
interface IActorRepo extends IRepo
{
    public function attachMovie(Movie $model, array $data = []);

    public function syncMovies(array $data = [], $detach = true);

    public function detachMovie(Movie $model);

    public function isAttachedToMovie($id);
}
