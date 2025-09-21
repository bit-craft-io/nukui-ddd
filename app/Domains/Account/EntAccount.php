<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Domains\Core\Entity\BaseEnt;

/**
 * @method _id(string $value)
 * @method _name(string $value)
 * @method _email(string $value)
 * @method _password(string $value)
 * @property-read int $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 */
class EntAccount extends BaseEnt
{
    public function setDefaults(): void
    {
        // TODO: Implement setUp() method.
    }
}
