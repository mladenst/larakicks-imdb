<?php

namespace App\Transformers;

use App\Models\Director;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of DirectorTransformer
 *
 * @author Dinkic
 */
class DirectorTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['movies'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Director $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeMovies(Director $item)
    {
        return $this->collection(
            $item->movies,
            new MovieTransformer()
        );
    }
}
