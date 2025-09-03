<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResError implements Responsable
{
    private bool $_is_success  = false;
    private string $_message = '';
    private int $_status_code = 0;

    public function init(Response $response): void
    {
        dd($response->getOriginalContent());
        $json_map = json_decode($response->getOriginalContent() ?? '{}', true);
        $this->_is_success = $json_map['is_success'] ?? false;
        $this->_message = $json_map['message'] ?? '';
        $this->_status_code = $response->getStatusCode() ?? 0;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            [
                'is_success' => $this->_is_success,
                'message' => $this->_message
            ],
            $this->_status_code
        );
    }
}
