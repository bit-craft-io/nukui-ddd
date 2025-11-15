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
    /**
     * @param int $amount
     * @return bool
     */
    public function has(int $amount): bool
    {
        return ($this->amount - $amount) >= 0;
    }

    /**
     * @param int $amount
     * @return void
     */
    public function sub(int $amount): void
    {
        $sub_amount = $this->amount - $amount;
        $this->amount(max($sub_amount, 0));
    }
}
