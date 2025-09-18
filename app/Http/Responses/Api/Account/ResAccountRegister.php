<?php

namespace App\Http\Responses\Api\Account;

use App\Libraries\Utils\UtilGlobals;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResAccountRegister extends JsonResponse
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'email' => UtilGlobals::find('email'),
            'password' => UtilGlobals::find('password')
        ];
        return response()->json($result)
            ->header('Login-Email', UtilGlobals::find('email'))
            ->header('Login-Password', UtilGlobals::find('password'));
    }
}
