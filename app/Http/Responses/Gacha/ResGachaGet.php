<?php

declare(strict_types=1);

namespace App\Http\Responses\Gacha;

use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Traits\TraitApplication;
use App\Core\Libraries\Traits\TraitDomain;
use App\Master\MstHub;
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
    use TraitApplication;

    public function toResponse(Request|ReqNone $req): JsonResponse
    {
        // @note Collection<Model>はビジネスロジックをModelに入れる事ができるが
        //       責任を分離の為、イテレータ用のクラスを作成
        $m_gachas = $this->_App::mst(MstHub::MST_GACHA)->getIterator();
        foreach($m_gachas as $m_gacha) {
            if (!$m_gacha->validate()) {
                // TODO エラーもしくはログ出力
                continue;
            }
            $this->_result['gachas'][] = $m_gacha->toArray();
        }

        $rep_gacha = $this->_Domain::rep(RepHub::REP_GACHA);
        $ent_gacha = $rep_gacha->find($req->user_id);
        $this->_result['u_gacha_info'] = $ent_gacha->toArray();

        $result = [
            'success' => 1,
            'result' => $this->_result
        ];
        return response()->json($result);
    }
}
