<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitDataSource;
use App\DataSources\DS;
use Illuminate\Support\Facades\Hash;

class UcCreateApiToken
{
    use TraitDataSource;

    public function execute(string $email, string $password): string
    {
        $account = $this->_ds(DS::DS_ACCOUNT)->findByEmail($email);
        if (!$account || !Hash::check($password, $account->password)) {
            return '';
        }
        return $account->createToken('api-token')->plainTextToken;
    }
}
