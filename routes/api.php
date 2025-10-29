<?php

use App\_Demo\Http\Controllers\CntDemo;
use App\Http\Controllers\CntAccount;
use App\Http\Controllers\CntDevelop;
use App\Http\Controllers\CntGacha;
use App\Http\Controllers\CntItem;
use App\Http\Controllers\CntUser;
use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'local') {
    Route::domain(env('APP_URL'))
        ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
        ->prefix('demo')
        ->controller(CntDemo::class)
        ->group(function () {
            Route::any('case01', 'case01');
            Route::any('case02', 'case02');
            Route::any('case03', 'case03');
            Route::any('cnt01', 'cnt01');
            Route::any('app01', 'app01');
            Route::any('req01', 'req01');
            Route::any('res01', 'res01');
            Route::any('infra01', 'infra01');
            Route::any('domain01', 'domain01');
            Route::any('anti01', 'anti01');
            Route::any('trial01', 'trial01');
            Route::any('bugfix01', 'bugfix01');
            Route::any('bench01', 'bench01');
        });
}

Route::domain(env('APP_URL'))
    ->middleware(['mdl.response', 'mdl.transaction'])
    ->prefix('account')
    ->controller(CntAccount::class)
    ->group(function () {
        Route::any('register', 'register');
        Route::any('login', 'login');
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
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('gacha')
    ->controller(CntGacha::class)
    ->group(function () {
        Route::any('get', 'get');
        Route::any('play', 'play');
    });

Route::domain(env('APP_URL'))
    ->middleware(['auth:sanctum', 'mdl.response', 'mdl.transaction'])
    ->prefix('develop')
    ->controller(CntDevelop::class)
    ->group(function () {
        Route::any('item-add', 'itemAdd');
        Route::any('item-sub', 'itemSub');
    });
