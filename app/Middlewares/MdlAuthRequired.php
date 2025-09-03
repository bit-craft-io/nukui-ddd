<?php

declare(strict_types=1);

namespace App\Middlewares;

use Closure;
use Illuminate\Http\Request;

//use Laravel\Sanctum\PersonalAccessToken;

/**
 * MdlAuthRequired
 */
class MdlAuthRequired
{
    //use AppLibException;
    //use LibValueObject;

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (is_null($token)) {
            if (isset($request->token)) {
                $token = $request->token;
            }
        }

        //if (is_null($token)) {
        //    $this->_exException()->failed(self::FAILED_UN_AUTH_ERROR);
        //}
        //
        ///** @var IVoToken $vo_token */
        //$vo_token = $this->valueObject()->find(IVoToken::class, ['now_token' => $token]);
        //if (!$vo_token->isValidToken()) {
        //    $this->_exException()->failed(self::FAILED_UN_AUTH_ERROR_TOKEN);
        //}
        //
        ///** @var PersonalAccessToken $model */
        //$model = $vo_token->findModelNowToken();
        //if (is_null($model)) {
        //    $this->_exException()->failed(self::FAILED_UN_AUTH_ERROR);
        //}
        //
        //$user_id = $model->tokenable_id ?? null;
        //if (is_null($user_id)) {
        //    $this->_exException()->failed(self::FAILED_UN_AUTH_ERROR);
        //}
        //
        //auth()->onceUsingId($user_id);

        return $next($request);
    }
}
