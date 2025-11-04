<?php

declare(strict_types=1);

namespace App\Http\Responses\Gacha;

use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Traits\TraitDomain;
use App\Domains\Gacha\VoMGacha;
use App\Domains\RepHub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read string $bearer_token
 */
final class ResGachaGet extends BaseRes
{
    // TODO use Traitの精査
    use TraitDomain;

    public function toResponse(Request|ReqNone $req): JsonResponse
    {
        // @note Collection<Model> にビジネスロジックを入れたく無い為、Voのイテレータを取得
        $vo_gachas = $this->_Domain::mstVo(VoMGacha::class)->get();
        foreach ($vo_gachas as $vo_gacha) {
            $vo_gacha->find($vo_gacha->id);
            if (!$vo_gacha->validate()) {
                continue;
            }
            $this->_result['gachas'][] = $vo_gacha->toArray();
        }

        $rep_gacha = $this->_Domain::rep(RepHub::REP_GACHA);
        $ent_gacha = $rep_gacha->find($req->user_id);
        $this->_result['u_gacha'] = $ent_gacha->toArray();

        $result = [
            'success' => 1,
            'result' => $this->_result
        ];
        return response()->json($result);
    }
}
