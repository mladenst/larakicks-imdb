    <?php

    use Illuminate\Http\Request;

    /*===================== UserController route module section =====================*/
    Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('me', 'UserController@me')
            ->name('users.me');
        
            Route::post('me', 'UserController@update')
            ->name('users.update');
        
            Route::get('favorite-movies', 'UserController@searchFavoriteMovies')
            ->name('users.searchFavoriteMovies');
        
            Route::post('favorite-movies/{movie_id}', 'UserController@attachFavoriteMovie')
            ->name('users.attachFavoriteMovie');
        
            Route::delete('favorite-movies/{movie_id}', 'UserController@detachFavoriteMovie')
            ->name('users.detachFavoriteMovie');
        
            Route::get('wishlist-movies', 'UserController@searchWishlistMovies')
            ->name('users.searchWishlistMovies');
        
            Route::post('wishlist-movies/{movie_id}', 'UserController@attachWishlistMovie')
            ->name('users.attachWishlistMovie');
        
            Route::delete('wishlist-movies/{movie_id}', 'UserController@detachWishlistMovie')
            ->name('users.detachWishlistMovie');
        
            Route::get('comments', 'UserController@searchComments')
            ->name('users.searchComments');
        });

        Route::apiResource('users', 'UserController', [
            'parameters' => [
                'users' => 'id',
            ],
            'only' => [
                
            ]
        ]);
    });
    /* End UserController route module section */
