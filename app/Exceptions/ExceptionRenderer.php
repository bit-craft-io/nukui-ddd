<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Libraries\Exceptions\ExException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class ExceptionRenderer
{
    private function _jsonResponse(string $body, int $status)
    {
        return response($body, $status)
            ->header('Content-Type', 'application/json')
            ->header('Cache-Control', 'no-cache')
            ->header('Content-Length', strlen($body));
    }

    public function render(Throwable $e, Request $request)
    {
        //app()->_isException = true;
        //$request->attributes->set('is_exception', true);

        if ($e instanceof ExException) {
            Log::emergency( '---------- ' . __CLASS__ . '::' . __LINE__);
            $response_json = json_encode($e->getErrorMap());
            $status = $e->getCode() === 200 ? 200 : 202;
            return $this->_jsonResponse($response_json, $status);
//            return response()->json($response_json, $status, ['Cache-Control' => 'no-cache',]);
        }

        if ($e instanceof Exception) {
            Log::emergency( '---------- ' . __CLASS__ . '::' . __LINE__);
            $response_json = json_encode($e->getErrorMap());
            $status = $e->getCode() === 200 ? 200 : 202;
            return $this->_jsonResponse($response_json, $status);
//            return response()->json($response_json, $status, ['Cache-Control' => 'no-cache',]);
        }

        if ($e instanceof ValidationException) {
            $response_json = json_encode($e->getMessage());
            return $this->_jsonResponse($response_json, 400);
            //return response()->json(['message' => $e->getMessage(),], 400);
        }

        if ($e instanceof \Error) {
            Log::emergency( '---------- ' . __CLASS__ . '::' . __LINE__);
            $response_json = json_encode($e->getMessage());
            return $this->_jsonResponse($response_json, 500);
            //return response()->json(['message' => 'error'], 500);
        }
        Log::emergency( '---------- ' . __CLASS__ . '::' . __LINE__);
        $response_json = json_encode($e->getMessage());
        return $this->_jsonResponse($response_json, 500);
        //return response()->json(['message' => $e->getMessage()], 402);
    }
}
