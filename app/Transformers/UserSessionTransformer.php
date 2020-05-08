<?php

namespace App\Transformers;

use App\Models\UserSession;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of UserSessionTransformer
 *
 * @author Dinkic
 */
class UserSessionTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['user'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(UserSession $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeUser(UserSession $item)
    {
        return $this->item($item->user, new UserTransformer());
    }
}
