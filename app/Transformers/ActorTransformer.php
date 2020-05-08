<?php

namespace App\Transformers;

use App\Models\Actor;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of ActorTransformer
 *
 * @author Dinkic
 */
class ActorTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['movies'];
    protected $pivotAttributes = ['role', 'role_type'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Actor $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeMovies(Actor $item)
    {
        return $this->collection(
            $item->movies,
            new MovieTransformer()
        );
    }
}
