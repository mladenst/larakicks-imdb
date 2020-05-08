<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use ApiModel;

    /*
     * Items per page (default=100)
     */
    protected $limit = 10;
    
    protected $table = "permissions";
       
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
    
    public function roles($q = null)
    {
        return $this->searchRelation(
            $this->belongsToMany(
                'App\Models\Role',
                'roles_permissions',
                'permission_id',
                'role_id'
            )->withTimestamps(),
            $q
        );
    }
}
