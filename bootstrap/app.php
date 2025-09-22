<?php

use App\Exceptions\AppException;
use App\Exceptions\ModelException;
use App\Http\Responses\Core\ResponseConfig;
use App\Http\Responses\ResError;
use App\Middlewares\MdlAfterExecute;
use App\Middlewares\MdlTransaction;
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
            'mdl.after.execute' => MdlAfterExecute::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request): JsonResponse {
            if ($e instanceof AppException) {
                return response()->json([
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 400);
            }
            if ($e instanceof ModelException) {
                return response()->json([
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ], 400);
            }
        });
    })->create();
