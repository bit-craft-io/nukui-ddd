<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\ValueObject\VoMItem;
use App\Libraries\Utils\UtilInstance;
use App\Libraries\Utils\UtilIterator;
use DateTimeInterface;

/**
 * @method _user_id(integer $value)
 * @method _item_id(integer $value)
 * @method _amount(integer $value)
 * @method _enabled_end_at(string $value)
 * @property-read integer $user_id
 * @property-read integer $item_id
 * @property-read integer $amount
 * @property-read DateTimeInterface $enabled_end_at
 */
class EntItem extends BaseEnt
{
    /** @var UtilIterator<VoMItem>|null  */
    protected ?UtilIterator $_vo_m_items = null;
    public function setDefaults(): void
    {
        $models = $this->_ds(DSs::DS_M_ITEM)->getEnable();
        $this->_vo_m_items = UtilInstance::singleton(VoMItem::class)->iterator($models);
    }

    public function addAmount(int $amount): void
    {
        $this->_amount($this->amount + $amount);
    }

    public function getEnabledEndAt(): ?string
    {
        $date = $this->enabled_end_at ?? $this->_vo_m_items->find($this->item_id)?->enabled_end_at;
        return $date?->format('Y-m-d H:i:s');
    }
}
