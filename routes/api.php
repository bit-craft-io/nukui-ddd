<?php

use App\_Demo\Http\Controllers\CntDemo;
use App\Http\Controllers\CntAccount;
use App\Http\Controllers\CntDevelop;
use App\Http\Controllers\CntItem;
use App\Http\Controllers\CntUser;
use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'local') {
    Route::domain(env('APP_URL'))
        ->middleware(['mdl.response', 'mdl.transaction'])
        ->prefix('demo')
        ->controller(CntDemo::class)
        ->group(function () {
            Route::any('case01', 'case01');
            Route::any('case02', 'case02');
            Route::any('case03', 'case03');
            Route::any('trial01', 'trial01');
            Route::any('trial02', 'trial02');
            Route::any('trial03', 'trial03');
            Route::any('anti01', 'anti01');
            Route::any('anti02', 'anti02');
            Route::any('anti03', 'anti03');
        });
}

Route::domain(env('APP_URL'))
    ->middleware(['mdl.response', 'mdl.transaction'])
    ->prefix('account')
    ->controller(CntAccount::class)
    ->group(function () {
        Route::any('register', 'register');
        Route::any('login', 'login');
        Route::any('dummy', 'dummy');
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('account')
    ->controller(CntAccount::class)
    ->group(function () {
        Route::any('dummy', 'dummy');
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('user')
    ->controller(CntUser::class)
    ->group(function () {
        Route::any('info', 'info');
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('item')
    ->controller(CntItem::class)
    ->group(function () {
        Route::any('get', 'get');
        Route::any('dummy', 'dummy');
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('develop')
    ->controller(CntDevelop::class)
    ->group(function () {
        Route::any('item-add', 'itemAdd');
    });
