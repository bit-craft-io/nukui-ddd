<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Domains\Core\Entity\BaseEnt;

/**
 * @method id(integer $value)
 * @method name(string $value)
 * @method email(string $value)
 * @method password(string $value)
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
}
