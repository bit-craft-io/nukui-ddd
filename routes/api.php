<?php

use App\Http\Controllers\Api\CntAccount;
use Illuminate\Support\Facades\Route;

Route::domain(env('APP_URL'))
    ->middleware(['mdl.after.execute', 'mdl.transaction'])
    ->prefix('account')
    ->controller(CntAccount::class)
    ->group(function () {
        Route::any('register', 'register');
        Route::any('login', 'login');
    })
;

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.after.execute', 'mdl.transaction'])
    ->prefix('account')
    ->controller(CntAccount::class)
    ->group(function () {
            Route::any('dummy', 'dummy');
    })
;
