<?php

namespace App\Repositories\Director;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Director;
use App\Models\Movie;

class EloquentDirector extends EloquentRepo implements IDirectorRepo
{
    public function __construct()
    {
    }

    /**
     * Configure the Model
     * */
    public function model()
    {
        return new Director;
    }

    public function attachMovie(Movie $model, array $data = [])
    {
        if (!$this->model) {
            return false;
        }
        
        $result = $this->model->movies()->attach($model, $data);
        
        return $this->finalize($this->model);
    }

    public function syncMovies(array $data = [], $detach = true)
    {
        return $this->sync('movies', $data, $detach);
    }

    public function detachMovie(Movie $model)
    {
        if (!$this->model) {
            return false;
        }
    
        $result = $this->model->movies()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function isAttachedToMovie($id)
    {
        return $this->isAttachedTo('movies', $id);
    }
}
