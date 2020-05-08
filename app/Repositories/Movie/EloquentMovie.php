<?php

namespace App\Repositories\Movie;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Director;
use App\Models\User;

class EloquentMovie extends EloquentRepo implements IMovieRepo
{
    public function __construct()
    {
    }

    /**
     * Configure the Model
     * */
    public function model()
    {
        return new Movie;
    }

    public function attachActor(Actor $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->actors()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachDirector(Director $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->directors()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachFavoritedUser(User $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->favoritedUsers()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function attachWishlistedUser(User $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->wishlistedUsers()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function syncActors(array $data = [], $detach = true)
    {
        return $this->sync('actors', $data, $detach);
    }

    public function syncDirectors(array $data = [], $detach = true)
    {
        return $this->sync('directors', $data, $detach);
    }

    public function syncFavoritedUsers(array $data = [], $detach = true)
    {
        return $this->sync('favoritedUsers', $data, $detach);
    }

    public function syncWishlistedUsers(array $data = [], $detach = true)
    {
        return $this->sync('wishlistedUsers', $data, $detach);
    }

    public function detachActor(Actor $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->actors()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachDirector(Director $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->directors()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachFavoritedUser(User $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->favoritedUsers()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function detachWishlistedUser(User $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->wishlistedUsers()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function isAttachedToActor($id)
    {
        return $this->isAttachedTo('actors', $id);
    }

    public function isAttachedToDirector($id)
    {
        return $this->isAttachedTo('directors', $id);
    }

    public function isAttachedToFavoritedUser($id)
    {
        return $this->isAttachedTo('favoritedUsers', $id);
    }

    public function isAttachedToWishlistedUser($id)
    {
        return $this->isAttachedTo('wishlistedUsers', $id);
    }
}
