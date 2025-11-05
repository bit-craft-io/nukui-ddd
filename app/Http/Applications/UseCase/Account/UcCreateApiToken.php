<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitInfrastructure;
use App\DataSources\DsHub;
use Illuminate\Support\Facades\Hash;

final class UcCreateApiToken
{
    use TraitInfrastructure;

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function execute(string $email, string $password): string
    {
        $account = $this->_Infra::ds(DsHub::DS_ACCOUNT)->findByEmail($email);
        if (!$account || !Hash::check($password, $account->password)) {
            return '';
        }
        return $account->createToken('api-token')->plainTextToken;
    }
}
