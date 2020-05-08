    <?php

    use Illuminate\Http\Request;

    /*===================== DirectorController route module section =====================*/
    Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function () {
        Route::group(['prefix' => 'directors'], function () {
            Route::get('{id}/movies', 'DirectorController@searchMovies')
            ->name('directors.searchMovies');
        
            Route::post('{id}/movies/{movie_id}', 'DirectorController@attachMovie')
            ->name('directors.attachMovie');
        
            Route::delete('{id}/movies/{movie_id}', 'DirectorController@detachMovie')
            ->name('directors.detachMovie');
        });

        Route::apiResource('directors', 'DirectorController', [
            'parameters' => [
                'directors' => 'id',
            ],
            'only' => [
                'index','show','store','update','destroy'
            ]
        ]);
    });
    /* End DirectorController route module section */
