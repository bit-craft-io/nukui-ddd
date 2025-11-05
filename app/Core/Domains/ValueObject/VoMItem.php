<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueObject;

use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;
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
class VoMItem extends BaseVo
{
    use TraitInfrastructure;

    public function find(int $id): self
    {
        $model = $this->_Infra::ds(DsHub::DS_M_ITEM)->findEnable($id);
        return $this->init($model);
    }

    public function getSumAmount(int $amount): int
    {
        return min($this->max_stock, $amount);
    }
}
