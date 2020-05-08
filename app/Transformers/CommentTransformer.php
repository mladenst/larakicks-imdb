<?php

namespace App\Transformers;

use App\Models\Comment;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of CommentTransformer
 *
 * @author Dinkic
 */
class CommentTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['creator'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Comment $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeCreator(Comment $item)
    {
        return $this->item($item->creator, new UserTransformer());
    }
}
