<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use ApiModel;

    /*
     * Items per page (default=100)
     */
    protected $limit = 10;
    
    protected $table = "comments";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = [
        'text',
        'rate'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'text',
        'rate'
    ];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = [
        'text',
        'rate'
    ];
    
    public $timestamps = true;
    
    public function creator($q = null)
    {
        return $this->searchRelation(
            $this->belongsTo('App\Models\User', 'creator_id'),
            $q
        );
    }
}
