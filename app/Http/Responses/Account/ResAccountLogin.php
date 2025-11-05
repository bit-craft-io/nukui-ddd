<?php

declare(strict_types=1);

namespace App\Http\Responses\Account;

use App\Core\Http\Responses\BaseRes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read string $bearer_token
 */
final class ResAccountLogin extends BaseRes
{
    /**
     * @param Request $req
     * @return JsonResponse
     */
    public function toResponse(Request $req): JsonResponse
    {
        $result = [
            'success' => 1,
        ];
        return response()->json($result)
            ->header('Content-Type', 'application/json')
            ->header('WWW-Authenticate', 'Bearer ' . $this->bearer_token);
    }
}
