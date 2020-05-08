<?php

namespace App\Transformers;

use App\Models\Movie;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of MovieTransformer
 *
 * @author Dinkic
 */
class MovieTransformer extends ApiTransformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = ['actors', 'directors', 'favoritedUsers', 'wishlistedUsers'];
    protected $pivotAttributes = ['role', 'role_type', 'note', 'rate'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Movie $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeActors(Movie $item)
    {
        return $this->collection(
            $item->actors,
            new ActorTransformer()
        );
    }
    public function includeDirectors(Movie $item)
    {
        return $this->collection(
            $item->directors,
            new DirectorTransformer()
        );
    }
    public function includeFavoritedUsers(Movie $item)
    {
        return $this->collection(
            $item->favoritedUsers,
            new UserTransformer()
        );
    }
    public function includeWishlistedUsers(Movie $item)
    {
        return $this->collection(
            $item->wishlistedUsers,
            new UserTransformer()
        );
    }
}
