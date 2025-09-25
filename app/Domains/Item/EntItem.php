<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\ValueObject\VoMItem;
use App\Libraries\Utils\UtilIterator;

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
    /** @var UtilIterator<VoMItem>|null  */
    protected ?UtilIterator $_vo_m_items = null;
    public function initOnce(): void
    {
        $models = $this->_ds(DSs::DS_M_ITEM)->getEnable();
        $this->_vo_m_items = $this->_vo(VoMItem::class)->iterator($models);
    }

    public function initAfter(): void
    {
        // TODO: Implement initAfter() method.
    }

    public function addAmount(int $amount): void
    {
        $sum = $this->amount + $amount;
        $vo_m_item = $this->_vo_m_items->find($this->item_id);

        // TODO
        dd($vo_m_item->type_item);

        $sum = min($vo_m_item->max_stock, $sum);
        $this->amount($sum);
    }

    public function getEnabledEndAt(): ?string
    {
        $date = $this->enabled_end_at
            ?? $this->_vo_m_items->find($this->item_id)?->enabled_end_at;
        return $date?->format('Y-m-d H:i:s');
    }
}
