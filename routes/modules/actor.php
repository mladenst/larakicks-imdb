    <?php

    use Illuminate\Http\Request;

    /*===================== ActorController route module section =====================*/
    Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function () {
        Route::group(['prefix' => 'actors'], function () {
            Route::get('{id}/movies', 'ActorController@searchMovies')
            ->name('actors.searchMovies');
        
            Route::post('{id}/movies/{movie_id}', 'ActorController@attachMovie')
            ->name('actors.attachMovie');
        
            Route::delete('{id}/movies/{movie_id}', 'ActorController@detachMovie')
            ->name('actors.detachMovie');
        });

        Route::apiResource('actors', 'ActorController', [
            'parameters' => [
                'actors' => 'id',
            ],
            'only' => [
                'index','show','store','update','destroy'
            ]
        ]);
    });
    /* End ActorController route module section */
