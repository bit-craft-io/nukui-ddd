<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitInfrastructure;
use App\Core\Libraries\Traits\TraitUtil;
use App\DataSources\DsHub;

final class UcMakeEmail
{
    use TraitInfrastructure;
    use TraitUtil;

    const string MAIL_DOMAIN = 'example.com';

    public function execute(): string
    {
        $ds_u_user = $this->_Infra::ds(DsHub::DS_U_USER);
        do {
            $random_key = $this->_UtilRandom::key(10, 10);
            $model = $ds_u_user->findByPublicId($random_key);
        } while ($model);
        return $random_key . '@' . self::MAIL_DOMAIN;
    }
}
