<?php

use App\Http\Controllers\Api\CntAccount;
use Illuminate\Support\Facades\Route;

//Route::domain(env('APP_URL'))->group(function () {
//    Route::middleware([
//        'mdl.after.execute',
//        'mdl.transaction'
//    ])->group(function () {
//        Route::prefix('account')->group(function () {
//            Route::any('register', [CntAccount::class, 'register']);
//        });
//    });
//});

Route::domain(env('APP_URL'))
    ->prefix('account')
    ->middleware(['mdl.after.execute', 'mdl.transaction'])
    ->controller(CntAccount::class)
    ->group(function () {
        Route::any('register', 'register');
        Route::any('login', 'login');
    })
;

Route::domain(env('APP_URL'))
    ->prefix('account')
    ->middleware(['auth:sanctum', 'mdl.after.execute', 'mdl.transaction'])
    ->controller(CntAccount::class)
    ->group(function () {
            Route::any('dummy', 'dummy');
    })
;
