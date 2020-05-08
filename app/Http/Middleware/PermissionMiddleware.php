<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Support\Enum\UserStatuses;
use ApiResponse;
use Lang;

/**
 * Adapted JWTMiddleware to work with ApiResponse
 */
class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $user = JWTAuth::parseToken()->toUser();

        foreach (explode('|', $permissions) as $permission) {
            if ($user->can($permission)) {
                return $next($request);
            }
        }

        return ApiResponse::Unauthorized(Lang::get('dinkoapi.auth.insufficient_permissions'), 401);
    }
}
