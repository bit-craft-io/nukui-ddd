<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Http\Responses\Core\BaseRes;
use App\Http\Responses\Core\ModifyRes;
use App\Http\Responses\Core\ResError;
use App\Libraries\Utils\UtilInstance;
use Illuminate\Support\Str;
use Closure;

final class MdlResponse
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (200 !== (int) $response->getStatusCode()) {
            $contents = json_decode($response->getContent(), true);
            $class = UtilInstance::singleton(ResError::class);
            $class->init([
                'code' => $contents['code'] ?? 0,
                'message' => $contents['message'] ?? ''
            ]);
            return $class->toResponse($request);
        }

        $class = ModifyRes::find($request);
        if ($class) {
            return $class->toResponse($request);
        }

        $uri_segments = explode('/', $request->route()->uri());
        $route = Str::studly(array_shift($uri_segments));
        $file = 'Res' . Str::studly(implode('_', $uri_segments));
        $domain = isset($uri_segments[0]) ? Str::studly($uri_segments[0]) : null;
        $response_class = "App\\Http\\Responses\\{$route}\\{$domain}\\{$file}";

        /** @var BaseRes $class */
        $class = UtilInstance::singleton($response_class);
        return $class->toResponse($request);
    }
}
