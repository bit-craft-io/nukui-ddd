<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueProxy\BaseVp;
use Carbon\CarbonImmutable;

/**
 * @method void _gacha_id(int $value)
 * @method void _exec_count(int $value)
 * @method void _exec_at(string $value)
 * @property-read integer $_gacha_id
 * @property-read integer $_exec_count
 * @property-read string $_exec_at
 */
class VpGachaInfo extends BaseVp
{
    public function addExecCount(): void
    {
        $this->_exec_count($this->_exec_count + 1);
        $this->_exec_at(CarbonImmutable::now()->toDateTimeString());
    }

    public function toArray(): array
    {
        return [
            '_exec_count' => $this->_exec_count,
            '_exec_at' => $this->_exec_at,
        ];
    }
}
