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
 * @property-read integer $group_no
 * @property-read integer $type_rarity
 * @property-read integer $type_entity
 * @property-read integer $entity_id
 * @property-read integer $entity_amount
 * @property-read integer $rate
 * @property-read string $ops_memo
 */
final class MstGachaLotEntity extends BaseMst
{
    /**
     * @return Collection
     */
    protected function _get(): Collection
    {
        return $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable();
    }

    /**
     * @param string $key_name
     * @return StfInsIterator<MstGacha>
     */
    public function getIterator(string $key_name = 'id'): StfInsIterator
    {
        return parent::iterator($this->_get(), $key_name);
    }

    /**
     * @param int $id
     * @return self
     */
    public function find(int $id): self
    {
        return $this->init($this->_Infra::ds(DsHub::DS_M_GACHA)->findEnable($id));
    }

    public function getByGroupNo(int $group_no): Collection
    {
        return $this->_Infra::ds(DsHub::DS_M_GACHA)->get(['group_no' => $group_no]);
    }

    public function toArray(): array
    {
        return [
            'group_no' => $this->group_no,
            'type_rarity' => $this->type_rarity,
            'type_entity' => $this->type_entity,
            'entity_id' => $this->entity_id,
            'entity_amount' => $this->entity_amount,
            'rate' => $this->rate,
            'ops_memo' => $this->ops_memo,
        ];
    }
}
