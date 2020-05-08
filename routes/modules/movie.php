    <?php

    use Illuminate\Http\Request;

    /*===================== MovieController route module section =====================*/
    Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function () {
        Route::group(['prefix' => 'movies'], function () {
            Route::get('{id}/favorited-users', 'MovieController@searchFavoritedUsers')
            ->name('movies.searchFavoritedUsers');
        
            Route::get('{id}/wishlisted-users', 'MovieController@searchWishlistedUsers')
            ->name('movies.searchWishlistedUsers');
        
            Route::get('{id}/actors', 'MovieController@searchActors')
            ->name('movies.searchActors');
        
            Route::post('{id}/actors/{actor_id}', 'MovieController@attachActor')
            ->name('movies.attachActor');
        
            Route::delete('{id}/actors/{actor_id}', 'MovieController@detachActor')
            ->name('movies.detachActor');
        
            Route::get('{id}/directors', 'MovieController@searchDirectors')
            ->name('movies.searchDirectors');
        
            Route::post('{id}/directors/{director_id}', 'MovieController@attachDirector')
            ->name('movies.attachDirector');
        
            Route::delete('{id}/directors/{director_id}', 'MovieController@detachDirector')
            ->name('movies.detachDirector');
        });

        Route::apiResource('movies', 'MovieController', [
            'parameters' => [
                'movies' => 'id',
            ],
            'only' => [
                'index','show','store','update','destroy'
            ]
        ]);
    });
    /* End MovieController route module section */
