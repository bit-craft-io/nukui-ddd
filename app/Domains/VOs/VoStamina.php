<?php

declare(strict_types=1);

namespace App\Domains\VOs;

use App\Libraries\Traits\VoAccessor;

/**
 * @method int getStaminaCount()
 */
class VoStamina
{
    use VoAccessor;
    protected int $_stamina_count = 0;

    public function consume(int $count = 1): void
    {
        $this->_stamina_count -= $count;
        $this->_parent->_stamina_count($this->_stamina_count);
    }

    public function recovery(int $count = 1): void
    {
        $this->_stamina_count += $count;
        $this->_parent->_stamina_count($this->_stamina_count);
    }
}
