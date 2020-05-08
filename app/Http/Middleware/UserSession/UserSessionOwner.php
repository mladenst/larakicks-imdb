<?php

namespace App\Http\Middleware\UserSession;

use Closure;
use Dinkara\DinkoApi\Http\Middleware\DinkoApiOwnerMiddleware;
use App\Repositories\UserSession\IUserSessionRepo;
use Tymon\JWTAuth\Facades\JWTAuth;
use ApiResponse;
use Lang;

class UserSessionOwner extends DinkoApiOwnerMiddleware
{
    
    /**
     * Create a new UserSession Middleware instance.
     *
     * @return void
     */
    public function __construct(IUserSessionRepo $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Extend logic if needed
         */
        $this->repo->find($request->id);

        $resource = $this->repo->getModel();

        $user = JWTAuth::parseToken()->toUser();

        if ($resource->user && $user && $resource->user->id != $user->id) {
            return ApiResponse::Unauthorized(Lang::get("dinkoapi.middleware.owner_failed"));
        }

        return $next($request);
    }
}
