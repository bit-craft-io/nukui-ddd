<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Http\Responses\BaseRes;
use App\Core\Http\Responses\ResError;
use App\Core\Libraries\Stateful\Static\StfStaInstance;
use App\Core\Libraries\Traits\TraitResponse;
use Closure;
use Illuminate\Support\Str;

final class MdlResponse
{
    use TraitResponse;

    private function _responseClass($request): BaseRes|string
    {
        $uri_segments = explode('/', $request->route()->uri());
        //$route = Str::studly(array_shift($uri_segments));
        array_shift($uri_segments);
        $domain = isset($uri_segments[0]) ? Str::studly($uri_segments[0]) : null;
        $file = 'Res' . Str::studly(implode('_', $uri_segments));
        //$response_class = "App\\Http\\Responses\\{$route}\\{$domain}\\{$file}";
        $response_class = "App\\Http\\Responses\\{$domain}\\{$file}";
        return StfStaInstance::singleton($response_class);
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (200 !== (int) $response->getStatusCode()) {
            $contents = json_decode($response->getContent(), true);
            $class = StfStaInstance::singleton(ResError::class);
            $class->init([
                'code' => $contents['code'] ?? 0,
                'message' => $contents['message'] ?? ''
            ]);
            return $class->toResponse($request);
        }

        $class = $this->_response()->modify::find();
        if (!$class) {
            $class = $this->_responseClass($request);
        }

        $class->setParams($this->_response()->param::get());
        return $class->toResponse($request);
    }
}
