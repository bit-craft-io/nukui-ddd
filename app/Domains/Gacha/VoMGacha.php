<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueObject\BaseVo;
use App\Models\Enums\TypeDraw;
use App\Models\Enums\TypeItem;

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
class VoMGacha extends BaseVo
{
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
