<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use ApiModel;

    /*
     * Items per page (default=100)
     */
    protected $limit = 10;
    
    protected $table = "actors";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = [
        'firstname',
        'lastname',
        'dob'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'dob'
    ];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = [
        'firstname',
        'lastname',
        'dob'
    ];
    
    public $timestamps = true;
    
    public function movies($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\Movie',
                'movies_actors',
                'actor_id',
                'movie_id'
            )->withTimestamps()->withPivot('role', 'role_type'),
            $q
        );
    }
}
