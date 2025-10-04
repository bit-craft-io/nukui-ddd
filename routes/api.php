<?php

use App\Http\Controllers\Api\CntAccount;
use App\Http\Controllers\Api\CntDevelop;
use App\Http\Controllers\Api\CntItem;
use App\Http\Controllers\Api\CntUser;
use Illuminate\Support\Facades\Route;

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
