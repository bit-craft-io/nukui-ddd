<?php

declare(strict_types=1);

namespace App\Http\Responses\Gacha;

use App\Core\Http\Requests\ReqNone;
use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\DataSources\DsHub;
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

    public function toResponse(Request|ReqNone $req): JsonResponse
    {
        $voMGachas = $this->_Domain::rep(RepHub::REP_GACHA)->getVoMGacha();
        foreach ($voMGachas as $voMGacha) {
            $this->_props['gachas'][] = $voMGacha->toArray();
        }
        $ent_gacha = $this->_Domain::rep(RepHub::REP_GACHA)->find($req->user_id);
        $this->_props['u_gacha_info'] = $ent_gacha->toArray();

        $result = [
            'success' => 1,
            'result' => $this->_props
        ];
        return response()->json($result);
    }
}
