<?php

use App\Libraries\Exceptions\ExException;
use App\Libraries\Macros\Request\MacroRequestServiceProvider;
use App\Middlewares\MdlAfterExecute;
use App\Middlewares\MdlAuthOptional;
use App\Middlewares\MdlAuthRequired;
use App\Middlewares\MdlTransaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

function jsonResponse(string $body, int $status)
{
    //dd(__LINE__, $body, $status);
    $ret = response($body, $status)
        ->header('Content-Type', 'application/json')
        ->header('Cache-Control', 'no-cache')
        ->header('Content-Length', strlen($body));
    dd($ret);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'index',
            'shared/*',
            'user/*',
        ]);
        $middleware->alias([
            'mdl.auth.required' => MdlAuthRequired::class,
            'mdl.auth.optional' => MdlAuthOptional::class,
            'mdl.transaction' => MdlTransaction::class,
            'mdl.after.execute' => MdlAfterExecute::class,
        ]);
    })
    ->withExceptions(
        function (Exceptions $exceptions) {
            $exceptions->render(function (Exception $e) {
                Log::emergency( '---------- withExceptions::' . __LINE__);
                app()->_isException = true;

                if ($e instanceof ExException) {
                    if ($e->getCode() === 200) {
                        Log::emergency( '---------- withExceptions::' . __LINE__);
                        $response_json = json_encode($e->getErrorMap());
                        return response($response_json, 200)
                            ->header('Content-Type', 'application/json')
                            ->header('Cache-Control', 'no-cache')
                            ->header('Content-Length', strlen($response_json));
                    }
                    Log::emergency( '---------- withExceptions::' . __LINE__);
                    //logger()->warning($e->getFile() . '::' . $e->getLine());

                    $response_json = json_encode($e->getErrorMap());
                    return response($response_json, 202)
                        ->header('Content-Type', 'application/json')
                        ->header('Cache-Control', 'no-cache')
                        ->header('Content-Length', strlen($response_json));
                }

                if ($e instanceof ValidationException) {
                    Log::emergency( '---------- withExceptions::' . __LINE__);
                    $response_json = json_encode(['message' => $e->getMessage()]);
                    return response($response_json, 400)
                        ->header('Content-Type', 'application/json')
                        ->header('Cache-Control', 'no-cache')
                        ->header('Content-Length', strlen($response_json));
                }
                Log::emergency( '---------- withExceptions::' . __LINE__);
                $message = $e->getMessage();
                //$message = 'error';
                $response_json = json_encode(['message' => $message]);
                return response($response_json, 402)
                    ->header('Content-Type', 'application/json')
                    ->header('Cache-Control', 'no-cache')
                    ->header('Content-Length', strlen($response_json));
            });

            Log::emergency( '---------- withExceptions::' . __LINE__);
            //logger()->error(substr($e->getMessage(), 0, 256));

            //$message = $exceptions->getMessage();
            $message = 'error';
            $response_json = json_encode(['message' => $message]);
            return response($response_json, 500)
                ->header('Content-Type', 'application/json')
                ->header('Cache-Control', 'no-cache')
                ->header('Content-Length', strlen($response_json));
//            });
        },
//        // @note 別案１
//        function (Exceptions $e) {
        //app()->_isException = true;
//        if ($e instanceof ExException) {
//            $response_json = json_encode($e->getErrorMap());
//            if ($e->getCode() === 200) {
//                return jsonResponse($response_json, 200);
//            }
//            //logger()->warning($e->getFile() . '::' . $e->getLine());
//            return jsonResponse($response_json, 202);
//        } elseif ($e instanceof ValidationException) {
//            $response_json = json_encode(['message' => $e->getMessage()]);
//            return jsonResponse($response_json, 400);
//        } elseif ($e instanceof Exception) {
//            dd(__LINE__);
//            //$message = $e->getMessage();
//            $message = 'error';
//            $response_json = json_encode(['message' => $message]);
//            return jsonResponse($response_json, 402);
//        } else {
//            //dd(__LINE__);
//            //logger()->error(substr($e->getMessage(), 0, 256));
//            //$message = $e->getMessage();
//            $message = 'error';
//            //$response_json = json_encode(['message' => $message]);
////            return jsonResponse('error', 500);
//            $response_json = json_encode(['message' => $message]);
//            //return jsonResponse($response_json, 402);
////            return response($response_json, 500)
////                ->header('Content-Type', 'application/json')
////                ->header('Cache-Control', 'no-cache')
////                ->header('Content-Length', strlen($response_json));
//        }
//        //dd(__LINE__);
////        }
        // @note 別案２

//        $e->render(function (Throwable $e, $request) {
////            if ($e instanceof ExException) {
////                return response()->json(['error' => $e->getMessage()], 202);
////            }
//            Log::emergency('例外発生 ========== :: ' . $e->getMessage());
//            //Log::emergency('---------- ' . __CLASS__ . '::' . __LINE__);
//            //$err = app(App\Exceptions\ExceptionRenderer::class);
//            //$err->render($e, $request);
//            //return app(App\Exceptions\ExceptionRenderer::class)->render($request, $e);
//            //return app(App\Exceptions\Handler::class)->render($request, $e);
//        });
//        //dd(__LINE__);
//        return response()->json(['error' => 'システムエラー'], 500);
//
//
////        Log::emergency('---------- ' . __CLASS__ . '::' . __LINE__);
////        $response_json = json_encode(['message' => 'aaa']);
////        return jsonResponse($response_json, 500);
//    }
    )
    ->withProviders([
        MacroRequestServiceProvider::class
    ])
    ->create();
