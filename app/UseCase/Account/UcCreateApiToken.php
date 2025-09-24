<?php

declare(strict_types=1);

namespace App\UseCase\Account;

use App\DataSources\DSs;
use App\Libraries\Traits\TraitDataSource;
use Illuminate\Support\Facades\Hash;

class UcCreateApiToken
{
    use TraitDataSource;

    public function execute(string $email, string $password): string
    {
        $account = $this->_ds(DSs::DS_ACCOUNT)->findByEmail($email);
        if (!$account || !Hash::check($password, $account->password)) {
            return '';
        }
        return $account->createToken('api-token')->plainTextToken;
    }
}
