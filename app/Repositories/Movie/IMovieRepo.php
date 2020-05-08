<?php

namespace App\Repositories\Movie;

use Dinkara\RepoBuilder\Repositories\IRepo;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Director;
use App\Models\User;

/**
 * Interface MovieRepository
 * @package App\Repositories\Movie
 */
interface IMovieRepo extends IRepo
{
    public function attachActor(Actor $model, array $data = []);

    public function attachDirector(Director $model, array $data = []);

    public function attachFavoritedUser(User $model, array $data = []);

    public function attachWishlistedUser(User $model, array $data = []);

    public function syncActors(array $data = [], $detach = true);

    public function syncDirectors(array $data = [], $detach = true);

    public function syncFavoritedUsers(array $data = [], $detach = true);

    public function syncWishlistedUsers(array $data = [], $detach = true);

    public function detachActor(Actor $model);

    public function detachDirector(Director $model);

    public function detachFavoritedUser(User $model);

    public function detachWishlistedUser(User $model);

    public function isAttachedToActor($id);

    public function isAttachedToDirector($id);

    public function isAttachedToFavoritedUser($id);

    public function isAttachedToWishlistedUser($id);
}
