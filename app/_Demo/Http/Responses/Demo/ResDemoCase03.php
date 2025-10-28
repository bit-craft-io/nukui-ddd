<?php

declare(strict_types=1);

namespace App\_Demo\Http\Responses\Demo;

use App\_Demo\DataSources\DsHub;
use App\_Demo\Http\Requests\Demo\ReqDemoCase01;
use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Traits\TraitInfra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ResDemoCase03 extends BaseRes
{
    use TraitInfra;

    /**
     * @param Request|ReqNone $req
     * @return JsonResponse
     */
    public function toResponse(Request|ReqNone $req): JsonResponse
    {
        // @note MDemoItem を取得して返す
        $req->user_id;
        $mDemoItems = $this->_Infra::ds(DsHub::DS_M_DEMO_ITEM)->getEnable();

        $result = [
            'success' => 1,
            'request' => ['m_demo_items' => $mDemoItems->toArray()],
        ];
        return response()->json($result);
    }
}
