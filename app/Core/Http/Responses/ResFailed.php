<?php

declare(strict_types=1);

namespace App\Core\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read integer $code
 * @property-read string $message
 */
final class ResFailed extends BaseRes
{
    public function toResponse(Request $req): JsonResponse
    {
        $result = [
            'success' => 0,
            'result' => (object)$this->_props,
            //'error_info' => [
            //    'code' =>  $this->code,
            //    'message' => $this->message
            //],
        ];
        return response()->json($result);
    }
}
