<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Http\Responses\BaseRes;
use App\Core\Http\Responses\ResError;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Traits\TraitResponse;
use Closure;
use Illuminate\Support\Str;

final class MdlResponse
{
    use TraitResponse;

    private function _responseClass($request): BaseRes|string
    {
        $uri = $request->route()->uri();
        $api = str_starts_with($uri, 'api/') ? substr($uri, 4) : $uri;
        $api_segments = explode('/', $api);
        $domain = Str::studly($api_segments[0] ?? '');
        $action = Str::studly($api_segments[1] ?? '');
        $controller = $request->route()->getAction()['controller'] ?? null;
        $namespace = preg_replace('/^(.*?\\\Http)\\\.*/', '$1', $controller);
        return StfStaFactory::singleton("$namespace\\Responses\\$domain\\Res{$domain}{$action}");
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (200 !== (int) $response->getStatusCode()) {
            $contents = json_decode($response->getContent(), true);
            $class = StfStaFactory::singleton(ResError::class);
            $class->init([
                'code' => $contents['code'] ?? 0,
                'message' => $contents['message'] ?? ''
            ]);
            return $class->toResponse($request);
        }

        $class = $this->_ResponseModify::find();
        if (!$class) {
            $class = $this->_responseClass($request);
        }

        $class->setParams($this->_ResponseParam::get());
        return $class->toResponse($request);
    }
}
