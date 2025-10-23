<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\ValueObject\VoMItem;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DS;

/**
 * @method void user_id(integer $value)
 * @method void item_id(integer $value)
 * @method void amount(integer $value)
 * @method void enabled_end_at(string $value)
 * @property-read integer $user_id
 * @property-read integer $item_id
 * @property-read integer $amount
 * @property-read object $enabled_end_at
 */
class EntItem extends BaseEnt
{
    /** @var StfInsIterator<VoMItem>|null  */
    protected ?StfInsIterator $_vo_m_items = null;
    public function initOnce(): void
    {
        $models = $this->_Infra::ds(DS::DS_M_ITEM)->getEnable();
        //$this->_vo_m_items = $this->_vo(VoMItem::class)->iterator($models);
        $this->_vo_m_items = $this->_Domain::vo(VoMItem::class)->iterator($models);
    }

    public function initAfter(): void
    {
        // TODO: Implement initAfter() method.
    }

    public function addAmount(int $amount): void
    {
        $sum = $this->amount + $amount;
        // TODO ValueProxy で処理
        $vo_m_item = $this->_vo_m_items->find($this->item_id);
        $sum = min($vo_m_item->max_stock, $sum);
        $this->amount($sum);
    }

    public function getEnabledEndAt(): ?string
    {
        if ($this->enabled_end_at) {
            return $this->enabled_end_at->format('Y-m-d H:i:s');
        }
        return $this->_vo_m_items->find($this->item_id)?->enabled_end_at;
    }
}
