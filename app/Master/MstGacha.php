<?php

declare(strict_types=1);

namespace App\Master;

use App\Core\Dictionary\BaseMst;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;
use App\Models\Enums\TypeDraw;

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
    /**
     * @param array $conditions
     * @param string $key_name
     * @return StfInsIterator<self>
 */
    public function get(array $conditions = [] , string $key_name = 'id'): StfInsIterator
    {
        $models = $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable($conditions);
        return parent::iterator($models, $key_name);
    }

    /**
     * @param int $id
     * @return self
     */
    public function find(int $id): self
    {
        return $this->init($this->_Infra::ds(DsHub::DS_M_GACHA)->findEnable($id));
    }

    public function validate(): bool
    {
        if ($this->gacha_lot_group_no <= 0) {
            return false;
        }

        if ($this->type_draw->isRarity()) {
            if ($this->gacha_lot_rarity_group_no <= 0) {
                return false;
            }
            return true;
        }

        //if ($this->type_draw->isNormal()) {
        //    return true;
        //}
        //
        //if ($this->type_draw->isStep()) {
        //    return true;
        //}
        //
        //if ($this->type_draw->isFixed()) {
        //    return true;
        //}

        return true;
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
