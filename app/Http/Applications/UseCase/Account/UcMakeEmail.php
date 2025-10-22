<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Stateless\Static\StlStaRandom;
use App\Core\Libraries\Traits\TraitInfra;
use App\DataSources\DS;

class UcMakeEmail
{
    use TraitInfra;

    const string MAIL_DOMAIN = 'example.com';

    public function execute(): string
    {
        $ds_u_user = $this->_infra::ds(DS::DS_U_USER);
        do {
            $random_key = StlStaRandom::key(10, 10);;
            $model = $ds_u_user->findByPublicId($random_key);
        } while ($model);
        return $random_key . '@' . self::MAIL_DOMAIN;
    }
}
