    <?php

    use Illuminate\Http\Request;

    /*===================== CommentController route module section =====================*/
    Route::middleware(['dinkoapi.auth', 'user.check.status'])->group(function () {
        Route::group(['prefix' => 'comments'], function () {
        });

        Route::apiResource('comments', 'CommentController', [
            'parameters' => [
                'comments' => 'id',
            ],
            'only' => [
                'index','show','store','update','destroy'
            ]
        ]);
    });
    /* End CommentController route module section */
