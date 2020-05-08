<?php

namespace App\Http\Middleware\Comment;

use Closure;
use Dinkara\DinkoApi\Http\Middleware\DinkoApiOwnerMiddleware;
use App\Repositories\Comment\ICommentRepo;
use Tymon\JWTAuth\Facades\JWTAuth;
use ApiResponse;
use Lang;

class CommentOwner extends DinkoApiOwnerMiddleware
{
    
    /**
     * Create a new Comment Middleware instance.
     *
     * @return void
     */
    public function __construct(ICommentRepo $repo)
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

        if ($resource->creator && $user && $resource->creator->id != $user->id) {
            return ApiResponse::Unauthorized(Lang::get("dinkoapi.middleware.owner_failed"));
        }

        return $next($request);
    }
}
