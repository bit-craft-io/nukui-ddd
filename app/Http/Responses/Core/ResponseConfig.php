<?php

declare(strict_types=1);

namespace App\Http\Responses\Core;

use App\Libraries\Utils\UtilInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ResponseConfig
{
    private static BaseRes $response;

    public static function modifyResponse(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = UtilInstance::singleton($response_class);
        self::$response = $response;
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
        $response_class = "App\\Http\\Responses\\{$route}\\{$domain}\\{$file}";

        /** @var BaseRes $response */
        $response = UtilInstance::singleton($response_class);
        self::$response = $response;

        return self::$response;
    }

    //public static function error($response): void
}
