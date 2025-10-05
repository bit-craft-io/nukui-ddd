<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Core\Domains\Entity\BaseEnt;

/**
 * @method void id(integer $value)
 * @method void name(string $value)
 * @method void email(string $value)
 * @method void password(string $value)
 * @property-read integer $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 */
class EntAccount extends BaseEnt
{
    public function initOnce(): void
    {
        // TODO: Implement setUp() method.
    }

    public function initAfter(): void
    {
        // TODO: Implement initAfter() method.
    }
}
