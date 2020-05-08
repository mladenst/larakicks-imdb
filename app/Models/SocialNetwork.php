<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialNetwork extends Model
{
    use ApiModel;

    /*
     * Items per page (default=100)
     */
    protected $limit = 10;
    
    protected $table = "social_networks";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = [
        'name'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = [
        'name'
    ];
    
    public $timestamps = true;
    
    public function users($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\User',
                'users_social_networks',
                'social_network_id',
                'user_id'
            )->withTimestamps()->withPivot('access_token', 'provider_id'),
            $q
        );
    }
}
