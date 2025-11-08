<?php

use App\Core\Exceptions\ExceptApp;
use App\Core\Exceptions\ExceptModel;
use App\Core\Http\Middlewares\MdlResponse;
use App\Core\Http\Middlewares\MdlTransaction;
use App\Core\Libraries\Stateful\Static\StfStaTransaction;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'mdl.transaction' => MdlTransaction::class,
            'mdl.response' => MdlResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // @note transaction rollback enable
        StfStaTransaction::enableRollback();

        $exceptions->render(function (Throwable $e, Request $request): JsonResponse {
            // TODO エラーの動作を確認
            $error = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
            if ($e instanceof ExceptApp) {
                return response()->json($error, 422);
            }
            if ($e instanceof ExceptModel) {
                return response()->json($error, 500);
            }
            return response()->json($error, 401);
        });
    })->create();
