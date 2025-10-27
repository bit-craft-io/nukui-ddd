<?php

declare(strict_types=1);

namespace App\_Demo\Http\Responses\Demo;

use App\_Demo\Http\Requests\Demo\ReqDemoCase01;
use App\Core\Http\Responses\BaseRes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ResDemoCase01 extends BaseRes
{
    /**
     * @param Request|ReqDemoCase01 $req
     * @return JsonResponse
     */
    public function toResponse(Request|ReqDemoCase01 $req): JsonResponse
    {
        $result = [
            'success' => 1,
            'request' => ['id' => $req->id, 'name' => $req->name],
        ];
        return response()->json($result);
    }
}
