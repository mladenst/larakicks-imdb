<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use ApiModel;

    /*
     * Items per page (default=100)
     */
    protected $limit = 10;
    
    protected $table = "movies";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = [
        'name',
        'genre',
        'release_date'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'genre',
        'release_date'
    ];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = [
        'name',
        'genre',
        'release_date'
    ];
    
    public $timestamps = true;
    
    public function actors($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\Actor',
                'movies_actors',
                'movie_id',
                'actor_id'
            )->withTimestamps()->withPivot('role', 'role_type'),
            $q
        );
    }
    public function directors($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\Director',
                'movies_directors',
                'movie_id',
                'director_id'
            )->withTimestamps(),
            $q
        );
    }
    public function favoritedUsers($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\User',
                'favorite_movies',
                'movie_id',
                'user_id'
            )->withTimestamps()->withPivot('note', 'rate'),
            $q
        );
    }
    public function wishlistedUsers($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\User',
                'wishlist_movies',
                'movie_id',
                'user_id'
            )->withTimestamps()->withPivot('note'),
            $q
        );
    }
}
