<?php

namespace App\Http\Responses\Api\Account;

use App\Libraries\Utils\UtilGlobals;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResAccountLogin extends JsonResponse
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'success' => 1,
        ];
        return response()->json($result)
            ->header('Content-Type', 'application/json')
            ->header('WWW-Authenticate', 'Bearer ' . UtilGlobals::find('bearer_token'));
    }
}
