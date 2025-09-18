<?php

declare(strict_types=1);

namespace App\Middlewares;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MdlAfterExecute
{
    public const int STATUS_SUCCESS = 200;
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $is_success = self::STATUS_SUCCESS === (int) $response->getStatusCode();
        if ($is_success) {
            $uri_segments = explode('/', $request->route()->uri());
            $route = Str::studly(array_shift($uri_segments));
            $file = 'Res' . Str::studly(implode('_', $uri_segments));
            $domain = isset($uri_segments[0]) ? Str::studly($uri_segments[0]) : null;
            $class_name = "App\\Http\\Responses\\{$route}\\{$domain}\\{$file}";
            if (class_exists($class_name)) {
                $class = app($class_name);
                /** @var FormRequest $request */
                return $class->toResponse($request);
            }
            // TODO
            dd(__LINE__);
        }
        // TODO
        dd(__LINE__);
    }
}
