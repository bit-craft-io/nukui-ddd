<?php

declare(strict_types=1);

namespace App\Http\Responses\Gacha;

use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Traits\TraitDictionary;
use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\DataSources\DsHub;
use App\Dictionary\DicHub;
use App\Dictionary\DicMGacha;
use App\Domains\RepHub;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property-read string $bearer_token
 */
final class ResGachaGet extends BaseRes
{
    // TODO ここで Infra を使用して良いかを再考
    use TraitInfra;
    use TraitDomain;
    use TraitDictionary;

    public function toResponse(Request|ReqNone $req): JsonResponse
    {
        // @note ディクショナリクラスはマスタのイテレータ
        //       マスタのイテレータにはビジネスロジックを入れる事ができる
        //       Collection<Model>はビジネスロジックを入れる事ができない
        $dic_gachas = $this->_Dict::iterator(DicHub::DIC_M_GACHA);
        foreach($dic_gachas as $dic_gacha) {
            $this->_result['gachas'][] = $dic_gacha->toArray();
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
