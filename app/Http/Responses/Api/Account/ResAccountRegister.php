<?php

declare(strict_types=1);

namespace App\Http\Responses\Api\Account;

use App\Http\Responses\Core\BaseRes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read string $primary_code
 */
final class ResAccountRegister extends BaseRes
{
    public function toResponse(Request $request): JsonResponse
    {
        $result = [
            'success' => 1,
        ];
        return response()->json($result)
            ->header('Content-Type', 'application/json')
            ->header('Primary-Code', $this->primary_code);
    }
}
