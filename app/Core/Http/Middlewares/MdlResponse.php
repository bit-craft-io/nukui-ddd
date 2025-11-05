<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Http\Responses\ResFailed;
use App\Core\Http\Responses\ResSuccess;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Traits\TraitResponse;
use Closure;
use Illuminate\Http\JsonResponse;

final class MdlResponse
{
    use TraitResponse;

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (200 !== (int) $response->getStatusCode()) {
            $contents = json_decode($response->getContent(), true);
            $class = StfStaFactory::singleton(ResFailed::class);
            $class->init([
                'code' => $contents['code'] ?? 0,
                'message' => $contents['message'] ?? ''
            ]);
            return $class->toResponse($request);
        }

        $class = $this->_ResponseModify::find();
        if ($class) {
            $class->setParams($this->_ResponseParam::get());
            return $class->toResponse($request);
        }

        $class = StfStaFactory::singleton(ResSuccess::class);
        $class->setParams($this->_ResponseParam::get());
        return $class->toResponse($request);
    }
}
