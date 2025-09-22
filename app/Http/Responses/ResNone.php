<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResNone extends BaseRes
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'success' => 1,
        ];
        return response()->json($result);
    }
}
