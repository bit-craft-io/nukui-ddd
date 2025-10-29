<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueProxy\BaseVp;

/**
 * @method void _exec_count(int $value)
 * @property-read integer $_exec_count
 */
class VpUGachaInfo extends BaseVp
{
    public function addExecCount(): void
    {
        $this->_exec_count($this->_exec_count + 1);
    }
}
