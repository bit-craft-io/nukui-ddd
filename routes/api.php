<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CntPlayer
};

Route::domain(env('APP_URL'))->group(function () {
    Route::middleware(['mdl.after.execute', 'mdl.transaction'])->group(function () {
        Route::middleware(['mdl.auth.optional'])->group(function () {
//            Route::prefix('player')->group(function () {
//                Route::get('find', [CntPlayer::class, 'find']);
//                Route::get('search', [CntPlayer::class, 'search']);
//            });
        });
    });
});
