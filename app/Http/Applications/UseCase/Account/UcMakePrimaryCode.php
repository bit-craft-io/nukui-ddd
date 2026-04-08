<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitUtil;

final class UcMakePrimaryCode
{
    use TraitUtil;

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function execute(string $email, string $password): string
    {
        // TODO 20260408
        return $this->_UtilCompress::comp("$email:$password");
    }
}
