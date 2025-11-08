<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Http\Requests\ReqNone;
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

        // @note コンストラクタインジェクションで BaseReq が無い場合の対応
        if (!ReqNone::$_is_merged_user_id) {
            StfStaFactory::new(ReqNone::class);
        }

        // TODO ここにもいる？
        if (200 !== (int) $response->getStatusCode()) {
            $contents = json_decode($response->getContent(), true);
            $class = StfStaFactory::singleton(ResFailed::class);
            //$class->init(['error_info' => ['code' => $contents['code'] ?? 0, 'message' => $contents['message'] ?? '']]);
            $class->setParams([
                'error_info' => [
                    'code' => $contents['code'] ?? 0,
                    'message' => $contents['message'] ?? ''
                ]
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
