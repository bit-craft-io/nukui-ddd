<?php

declare(strict_types=1);

namespace App\Domains\Gacha\Service;

use App\Core\Libraries\Traits\TraitApplication;
use App\Master\MstGacha;

class SvcGacha
{
    use TraitApplication;

    public function draw(MstGacha $m_gacha): array
    {
        return match(true) {
            $m_gacha->type_draw->isNormal() => $this->normal($m_gacha),
        };
    }

    public function normal(MstGacha $m_gacha): array
    {
        return [];
//        $m_gacha = $this->_App::mst(MstHub::MST_GACHA)->find($gacha_id);
//        $m_gacha_lot_entities = $this->_App::mst(MstHub::MST_GACHA_LOT_ENTITY)->getByGroupNo($m_gacha->gacha_lot_group_no);
//        dd($m_gacha_lot_entities->toArray());
    }
//
//    public function step(int $gacha_id): string
//    {
//
//    }
//
//    public function fixed(int $gacha_id): string
//    {
//
//    }
}
