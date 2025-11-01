<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\ValueProxy\VpItem;
use App\DataSources\DsHub;

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
class EntItem extends BaseEnt
{
    ///** @var StfInsIterator<VoMItem>|null  */
    //protected ?StfInsIterator $_vo_m_items = null;
    protected array $_m_item_map = [];

    protected VpItem $_vp_item;

    public function initOnce(): void
    {
        $models = $this->_Infra::ds(DsHub::DS_M_ITEM)->getEnable();

        // @note vo の iterator より map の方が扱いやすそう
        //$this->_vo_m_items = $this->_Domain::vo(VoHub::VO_M_ITEM)->iterator($models, 'id');

        $this->_m_item_map = $models->keyBy('id')->toArray();
    }

    public function initAfter(): void
    {
        $this->_vp_item = $this->_Domain::vo(VpHub::VP_ITEM)->init($this);
    }

    public function addAmount(int $amount): void
    {
        // @note 責任を分離した場合の処理
        //       max_stock は m_items の値の為 $vo_m_items に問い合わせ
        // $vo_m_items = $this->_vo_m_items?->find($this->item_id);
        // $sum_amount = $vo_m_items->minAmount($this->amount + $amount);
        // $this->_vp_item->add($sum_amount);

        //$m_item = $this->_m_item_map[$this->item_id];
        //$sum_amount = min($m_item['max_stock'], $this->amount + $amount);
        $this->_vp_item->amount($amount);
    }

    public function subAmount(int $amount): void
    {
        $this->_vp_item->sub($amount);
    }

    public function hasAmount(int $amount): bool
    {
        return $this->_vp_item->has($amount);
    }

    public function getMItemEndAt(): ?string
    {
        if ($this->end_at) {
            return $this->end_at->toDateTimeString();
        }
        //return $this->_vo_m_items->find($this->item_id)?->end_at;
        return $this->_m_item_map[$this->item_id]['end_at'] ?? null;
        //return  data_get($this->_m_item_map, $this->item_id . '.end_at');
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->item_id,
            'amount' => $this->amount,
            'end_at' => $this->end_at?->toDateTimeString(),
        ];
    }
}
