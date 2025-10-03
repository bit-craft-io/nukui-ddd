<?php

declare(strict_types=1);

namespace App\Http\Responses\Core;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ResNone extends BaseRes
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'success' => 1,
        ];
        return response()->json($result);
    }
}
