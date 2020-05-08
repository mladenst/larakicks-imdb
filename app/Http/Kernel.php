<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'dinkoapi.auth' => \Dinkara\DinkoApi\Http\Middleware\DinkoApiAuthMiddleware::class,
        'user.check.status' => \App\Http\Middleware\CheckUserStatusMiddleware::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'permission' => \App\Http\Middleware\PermissionMiddleware::class,
        'exists.actor' => \App\Http\Middleware\Actor\ActorExists::class,
        'exists.comment' => \App\Http\Middleware\Comment\CommentExists::class,
        'exists.director' => \App\Http\Middleware\Director\DirectorExists::class,
        'exists.movie' => \App\Http\Middleware\Movie\MovieExists::class,
        'exists.permission' => \App\Http\Middleware\Permission\PermissionExists::class,
        'exists.profile' => \App\Http\Middleware\Profile\ProfileExists::class,
        'exists.role' => \App\Http\Middleware\Role\RoleExists::class,
        'exists.socialnetwork' => \App\Http\Middleware\SocialNetwork\SocialNetworkExists::class,
        'exists.usersession' => \App\Http\Middleware\UserSession\UserSessionExists::class,
        'exists.user' => \App\Http\Middleware\User\UserExists::class,
        'owns.comment' => \App\Http\Middleware\Comment\CommentOwner::class,
        'owns.profile' => \App\Http\Middleware\Profile\ProfileOwner::class,
        'owns.usersession' => \App\Http\Middleware\UserSession\UserSessionOwner::class,
    
    ];
}
