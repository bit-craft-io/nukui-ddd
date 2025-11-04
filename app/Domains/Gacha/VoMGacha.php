<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueObject\BaseMstVo;
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

    public function enoughCost(int $u_entity_amount): bool
    {
        return $this->total_cost_amount <= $u_entity_amount;
    }

    public function toArray()
    {
        return [
            'if' => $this->id,
            'name' => $this->name,
            'type_draw' => $this->type_draw,
            'group_no' => $this->group_no,
            'exec_count' => $this->exec_count,
            'type_cost' => $this->type_cost,
            'cost_id' => $this->cost_id,
            'total_cost_amount' => $this->total_cost_amount,
            'draw_count' => $this->draw_count,
            'banner_image_name' => $this->banner_image_name,
        ];
    }
}
