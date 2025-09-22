<?php

namespace App\Http\Responses\Core;

use App\Http\Responses\ResError;
use App\Libraries\Utils\UtilInstance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ResponseConfig
{
    protected static ?object $response = null;

    public static function modifyResponse(string $response): void
    {
        self::$response = UtilInstance::singleton($response);
    }

    public static function modifyResponseError(array $contents): void
    {
        self::$response = UtilInstance::singleton(ResError::class);
        self::$response->init([
            'code' => $contents['code'] ?? 0,
            'message' => $contents['message'] ?? ''
        ]);
    }

    public static function find(Request $request): ?object
    {
        if (self::$response) {

            return self::$response;
        }

        $uri_segments = explode('/', $request->route()->uri());
        $route = Str::studly(array_shift($uri_segments));
        $file = 'Res' . Str::studly(implode('_', $uri_segments));
        $domain = isset($uri_segments[0]) ? Str::studly($uri_segments[0]) : null;
        $class_name = "App\\Http\\Responses\\{$route}\\{$domain}\\{$file}";
        self::$response = UtilInstance::singleton($class_name);

        return self::$response;
    }

    //public static function error($response): void
}
