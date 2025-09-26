<?php

declare(strict_types=1);

namespace App\Http\Responses\Core;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read integer $code
 * @property-read string $message
 */
class ResError extends BaseRes
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'success' => 0,
            'error_info' => [
                'code' =>  $this->code,
                'message' => $this->message
            ],
        ];
        return response()->json($result);
    }
}
