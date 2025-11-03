<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueObject\BaseMstVo;
use App\Core\Domains\ValueObject\BaseVo;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;
use App\Models\Enums\TypeCost;
use App\Models\Enums\TypeDraw;

/**
 * @property-read integer $id
 * @property-read string $name
 * @property-read integer $is_active
 * @property-read string $begin_at
 * @property-read string $end_at
 * @property-read TypeDraw $type_draw
 * @property-read integer $group_no
 * @property-read integer $exec_count
 * @property-read TypeCost $type_cost
 * @property-read integer $cost_id
 * @property-read integer $total_cost_amount
 * @property-read integer $draw_count
 * @property-read integer $gacha_draw_rarity_group_no
 * @property-read integer $gacha_draw_entity_group_no
 * @property-read integer $display_order
 * @property-read string $banner_image_name
 */
class VoMGacha extends BaseMstVo
{
    //public function find(int $id): self
    //{
    //    $model = $this->_Infra::ds(DsHub::DS_M_GACHA)->findEnable($id);
    //    return $this->init($model);
    //}
    //
    ///**
    // * @return StfInsIterator<self>
    // */
    //public function get(): StfInsIterator
    //{
    //    $models = $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable();
    //    return $this->iterator($models);
    //}

    public function validate(): bool
    {
        if ($this->gacha_draw_entity_group_no <= 0) {
            return false;
        }

        if ($this->type_draw->isRarity()) {
            if ($this->gacha_draw_rarity_group_no <= 0) {
                return false;
            }
            return true;
        }

        return true;
    }

    public function validateCost(int $u_entity_amount): bool
    {
        return $this->total_cost_amount <= $u_entity_amount;
    }

}
