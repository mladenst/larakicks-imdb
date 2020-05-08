<?php

namespace App\Repositories\Director;

use Dinkara\RepoBuilder\Repositories\IRepo;
use App\Models\Director;
use App\Models\Movie;

/**
 * Interface DirectorRepository
 * @package App\Repositories\Director
 */
interface IDirectorRepo extends IRepo
{
    public function attachMovie(Movie $model, array $data = []);

    public function syncMovies(array $data = [], $detach = true);

    public function detachMovie(Movie $model);

    public function isAttachedToMovie($id);
}
