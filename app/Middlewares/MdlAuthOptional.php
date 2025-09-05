<?php

declare(strict_types=1);

namespace App\Middlewares;

use Closure;
use Illuminate\Http\Request;

//use Laravel\Sanctum\PersonalAccessToken;

/**
 * MdlAuthOptional
 */
class MdlAuthOptional
{
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

        if (is_null($token)) {
            return $next($request);
        }

        ///** @var IVoToken $vo_token */
        //$vo_token = $this->valueObject()->find(IVoToken::class, ['now_token' => $token]);
        //if (!$vo_token->isValidToken()) {
        //    return $next($request);
        //}

        ///** @var PersonalAccessToken $model */
        //$model = $vo_token->findModelNowToken();
        //if (is_null($model)) {
        //    return $next($request);
        //}

        $user_id = $model->tokenable_id ?? null;
        if (is_null($user_id)) {
            return $next($request);
        }

        auth()->onceUsingId($user_id);

        return $next($request);
    }
}
