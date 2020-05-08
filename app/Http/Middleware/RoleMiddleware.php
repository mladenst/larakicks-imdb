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
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $user = JWTAuth::parseToken()->toUser();

        foreach (explode('|', $roles) as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        return ApiResponse::Unauthorized(Lang::get('dinkoapi.auth.insufficient_permissions'), 401);
    }
}
