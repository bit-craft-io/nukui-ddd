<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Http\Responses\ResDevNone;
use App\Http\Responses\ResError;
use App\Libraries\Response;
use App\Libraries\Shared\SharedHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Closure;

/**
 * MdlAfterExecute
 */
class MdlAfterExecute
{
    // TODO トレイトにするか判断
    protected function _response(): Response
    {
        return SharedHelper::singleton(Response::class);
    }

    public const int STATUS_SUCCESS = 200;

    public function handle($request, Closure $next)
    {
Log::error( '---------- ' . __CLASS__ . '::' . __LINE__);
        $response = $next($request);
        $is_success = self::STATUS_SUCCESS === (int) $response->getStatusCode();
Log::error( '---------- ' . __CLASS__ . '::' . __LINE__);
        if ($is_success) {
            $modify_response_class = $this->_response()->findModify();
            if ($modify_response_class) {
                $class = app($modify_response_class);
                return $class->toResponse($request);
            }

            $redirect_url = $this->_response()->findRedirectUrl();
            if (!empty($redirect_url)) {
                return redirect($redirect_url);
            }

            $file = 'Res' . Str::studly(str_replace(DIRECTORY_SEPARATOR, '_', $request->route()->uri()));
            $dir = Str::studly(Str::before($request->route()->uri(), '/'));
            $class_name = "App\Http\Responses\\$dir\\$file";
            if (class_exists($class_name)) {
                $class = app($class_name);
                /** @var FormRequest $request */
                return $class->toResponse($request);
            }
        }

        //dd($response);
        // TODO この処理を整理
        //$class = $this->_response()->error($response);
        //$class = SharedHelper::singleton(Response::class)->error($response);
        //$class = SharedHelper::singleton(ResError::class);
        $class = SharedHelper::singleton(ResDevNone::class);
//        $class->init($response);
//        return $class;
Log::info( '---------- ' . __CLASS__ . '::' . __LINE__);
        /** @var FormRequest $request */
        return $class->toResponse($request);
    }
}
