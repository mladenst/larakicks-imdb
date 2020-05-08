<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(250);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models = array(
            'Actor',
            'Comment',
            'Director',
            'Movie',
            'PasswordReset',
            'Permission',
            'Profile',
            'Role',
            'SocialNetwork',
            'UserSession',
            'User'
        );
        
        foreach ($models as $idx => $model) {
            $this->app->bind(
                "App\Repositories\\{$model}\I{$model}Repo",
                "App\Repositories\\{$model}\\Eloquent{$model}"
            );
        }
    }
}
