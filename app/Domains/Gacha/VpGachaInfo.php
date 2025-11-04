<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\ValueProxy\BaseVp;
use Carbon\CarbonImmutable;

/**
 * @method void gacha_info(array $values)
 * @property array $gacha_info
 */
class VpGachaInfo extends BaseVp
{
    protected array $_gacha_info = [
        'exec_count' => 0,
        'exec_at' => '',
    ];

    public function addExecCount(int $group_no): void
    {
        $gacha_info = $this->gacha_info;

        if (empty($gacha_info[$group_no])) {
            $gacha_info[$group_no] = $this->_gacha_info;
        }
        $gacha_info[$group_no]['exec_count'] += 1;
        $gacha_info[$group_no]['exec_at'] = CarbonImmutable::now()->toDateTimeString();

        ksort($gacha_info);
        $this->gacha_info($gacha_info);
    }

    public function toArray(): array
    {
        return $this->gacha_info;
    }
}
