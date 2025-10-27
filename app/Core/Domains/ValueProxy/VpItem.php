<?php

declare(strict_types=1);

namespace App\Core\Domains\ValueProxy;

/**
 * @method void amount(integer $value)
 * @property-read integer $item_id
 * @property-read integer $amount
 */
class VpItem extends BaseVp
{
    public function has(int $amount): bool
    {
        return ($this->amount - $amount) >= 0;
    }

    public function sub(int $amount): void
    {
        $subAmount = $this->amount - $amount;
        $this->amount(max($subAmount, 0));
    }

    public function add(int $amount, int $max_stock): void
    {
        $sum = min($max_stock, $this->amount + $amount);
        $this->amount($sum);
    }
}
