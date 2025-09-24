<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Http\Responses\Core\ResponseConfig;
use Closure;

final class MdlAfterExecute
{
    public const int STATUS_SUCCESS = 200;
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $is_success = self::STATUS_SUCCESS === (int) $response->getStatusCode();
        if (!$is_success) {
            $contents = json_decode($response->getContent(), true);
            ResponseConfig::modifyResponseError($contents);
        }

        $class = ResponseConfig::find($request);
        if ($class) {
            return $class->toResponse($request);
        }

        // TODO
        dd(__LINE__);
    }
}
