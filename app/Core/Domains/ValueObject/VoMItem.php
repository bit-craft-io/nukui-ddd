<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Models\Enum\TypeItem;

/**
 * @property-read integer $id
 * @property-read string $name
 * @property-read TypeItem $type_item
 * @property-read integer $max_display
 * @property-read integer $max_stock
 * @property-read string $begin_at
 * @property-read string $end_at
 */
class VoMItem extends BaseMstVo
{
    /**
     * @param int $amount
     * @return int
     */
    public function clampToMaxStock(int $amount): int
    {
        return min($this->max_stock, $amount);
    }
}
