<?php

declare(strict_types=1);

namespace App\Core\Http\Middlewares;

use App\Core\Exceptions\Enums\TypeExcept;
use App\Core\Http\Requests\BaseReq;
use App\Core\Http\Responses\ResSuccess;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Traits\TraitException;
use App\Core\Libraries\Traits\TraitResponse;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;

final class MdlResponse
{
    use TraitResponse;
    use TraitException;

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // @note BaseReq を継承したクラスをコンストラクタインジェクションして無い場合
        //       ミドルウェアはクロージャを入れ子の状態にして実行する為
        //       BaseReq の処理が実行されない状態で本処理が実行される
        if (!BaseReq::$_is_merged_user_id) {
            $request->merge(['user_id' => ($request?->user()->id ?? null)]);
        }

        if (200 !== (int) $response->getStatusCode()) {
            throw $this->_Except::app(TypeExcept::AppNotOkStatus);
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
