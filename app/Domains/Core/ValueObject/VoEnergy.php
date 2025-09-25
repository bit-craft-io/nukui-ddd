<?php

declare(strict_types=1);

namespace App\Domains\Core\ValueObject;

/**
 * @method void energy(integer $value)
 * @property-read $energy
 * @property-read $energy_max_regen
 * @property-read $energy_max_stock
 */
class VoEnergy extends BaseEntVo
{
    public function recover(int $value): void
    {
        $recover = min($this->energy_max_stock, ($this->energy + $value));
        $this->energy($recover);
    }

    public function consume(int $value): void
    {
        $sub = max(($this->energy - $value), 0);
        $this->energy($sub);
    }
}
