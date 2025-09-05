<?php

declare(strict_types=1);

namespace App\Domains\Guild;

use App\Domains\BaseEnt;

/**
 * このクラスの要約
 *
 * @method _id(int $value)
 * @method _name(?string $value)
 * @method _upper_limit_count(int $value)
 *
 * @property-read int $id
 * @property-read ?string $name
 * @property-read int $upper_limit_count
 */
class EntGuild extends BaseEnt
{
    public function isRequestPossible(): bool
    {
        // TODO dummy
        return false;
    }
}
