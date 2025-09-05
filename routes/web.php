<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CntPlayable, CntPlayer, CntRoot};

//if (config('app.xhprof') ?? false) {
//    xhprof_enable();
//}

Route::domain(env('APP_URL'))->group(function () {
    Route::middleware(['mdl.after.execute', 'mdl.transaction'])->group(function () {
        Route::middleware(['mdl.auth.optional'])->group(function () {
            Route::group(['prefix' => '', 'as' => '.'], function () {
                Route::get('', [CntRoot::class, 'index']);
            });
            Route::group(['prefix' => 'playable', 'as' => '.'], function () {
                Route::get('find', [CntPlayable::class, 'find']);
                Route::get('search', [CntPlayable::class, 'search']);
            });
            Route::prefix('player')->group(function () {
                Route::get('find', [CntPlayer::class, 'find']);
                Route::get('search', [CntPlayer::class, 'search']);
                Route::get('search-type-a', [CntPlayer::class, 'search_type_a']);
                Route::get('search-type-b', [CntPlayer::class, 'search_type_a']);
            });
        });
    });
});

//if (config('app.xhprof') ?? false) {
//    (new XHProfRuns_Default())->save_run(xhprof_disable(), config('app.name'));
//}
