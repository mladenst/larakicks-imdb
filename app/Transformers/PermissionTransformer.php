<?php

namespace App\Transformers;

use App\Models\Permission;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of PermissionTransformer
 *
 * @author Dinkic
 */
class PermissionTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['roles'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Permission $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeRoles(Permission $item)
    {
        return $this->collection(
            $item->roles,
            new RoleTransformer()
        );
    }
}
