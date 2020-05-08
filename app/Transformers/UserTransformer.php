<?php

namespace App\Transformers;

use App\Models\User;
use Dinkara\DinkoApi\Transformers\ApiTransformer;

/**
 * Description of UserTransformer
 *
 * @author Dinkic
 */
class UserTransformer extends ApiTransformer
{
    protected $defaultIncludes = ['profile'];
    protected $availableIncludes = ['userSessions', 'comments', 'roles', 'socialNetworks', 'favoriteMovies', 'wishlistMovies'];
    protected $pivotAttributes = ['access_token', 'provider_id', 'note', 'rate'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(User $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeProfile(User $item)
    {
        return $this->item($item->profile, new ProfileTransformer());
    }
    public function includeUserSessions(User $item)
    {
        return $this->collection(
            $item->userSessions,
            new UserSessionTransformer()
        );
    }
    public function includeComments(User $item)
    {
        return $this->collection(
            $item->comments,
            new CommentTransformer()
        );
    }
    public function includeRoles(User $item)
    {
        return $this->collection(
            $item->roles,
            new RoleTransformer()
        );
    }
    public function includeSocialNetworks(User $item)
    {
        return $this->collection(
            $item->socialNetworks,
            new SocialNetworkTransformer()
        );
    }
    public function includeFavoriteMovies(User $item)
    {
        return $this->collection(
            $item->favoriteMovies,
            new MovieTransformer()
        );
    }
    public function includeWishlistMovies(User $item)
    {
        return $this->collection(
            $item->wishlistMovies,
            new MovieTransformer()
        );
    }
}
