<?php

declare(strict_types=1);

namespace App\_Demo\Domains\DemoItem;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\ValueObject\VoMItem;
use App\Core\Domains\ValueProxy\VpItem;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;
use App\Domains\Item\VoHub;
use App\Domains\Item\VpHub;

/**
 * @method void user_id(integer $value)
 * @method void item_id(integer $value)
 * @method void amount(integer $value)
 * @method void end_at(string $value)
 * @property-read integer $user_id
 * @property-read integer $item_id
 * @property-read integer $amount
 * @property-read object $end_at
 */
class EntDemoItem extends BaseEnt
{
    /** @var StfInsIterator<VoMItem>|null  */
    protected ?StfInsIterator $_vo_m_items = null;

    protected VpItem $_vp_item;

    public function initOnce(): void
    {
        $models = $this->_Infra::ds(DsHub::DS_M_ITEM)->getEnable();
        $this->_vo_m_items = $this->_Domain::vo(VoHub::VO_M_ITEM)->iterator($models, 'id');
    }

    public function initAfter(): void
    {
        $this->_vp_item = $this->_Domain::vo(VpHub::VP_ITEM)->init($this);
    }

    public function addAmount(int $amount): void
    {
        $max_stock = $this->_vo_m_items?->find($this->item_id)->max_stock;
        $this->_vp_item->add($amount, $max_stock);
    }

    public function subAmount(int $amount): void
    {
        $this->_vp_item->sub($amount);
    }

    public function getMItemEndAt(): ?string
    {
        if ($this->end_at) {
            return $this->end_at->toDateTimeString();
        }
        return $this->_vo_m_items->find($this->item_id)?->end_at;
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->item_id,
            'amount' => $this->amount,
            'end_at' => $this->end_at->toDateTimeString(),
        ];
    }
}
