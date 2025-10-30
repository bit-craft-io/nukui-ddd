<?php

declare(strict_types=1);

namespace App\Master;

use App\Core\Dictionary\BaseMst;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;
use App\Models\Enums\TypeDraw;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property-read integer $id
 * @property-read string $name
 * @property-read integer $is_active
 * @property-read TypeDraw $type_draw
 * @property-read integer $group_no
 * @property-read integer $exec_count
 * @property-read integer $item_id
 * @property-read integer $total_cost
 * @property-read integer $draw_count
 * @property-read integer $gacha_lot_rarity_group_no
 * @property-read integer $gacha_lot_group_no
 * @property-read string $begin_at
 * @property-read string $end_at
 * @property-read integer $display_order
 * @property-read string $banner_image_name
 */
final class MstGacha extends BaseMst
{
    protected function _getCollect(): Collection
    {
        return $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable();
    }

    public function getIterator(string $key_name = 'id'): StfInsIterator
    {
        parent::iterator($this->_getCollect(), $key_name);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type_draw' => $this->type_draw,
            'item_id' => $this->item_id,
            'total_cost' => $this->total_cost,
            'draw_count' => $this->draw_count,
            'begin_at' => $this->begin_at,
            'end_at' => $this->end_at,
            'banner_image_name' => $this->banner_image_name,
        ];
    }
}
