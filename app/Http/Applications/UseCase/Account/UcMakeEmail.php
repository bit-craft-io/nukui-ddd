<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitInfra;
use App\Core\Libraries\Traits\TraitUtil;
use App\DataSources\DS;

final class UcMakeEmail
{
    use TraitInfra;
    use TraitUtil;

    const string MAIL_DOMAIN = 'example.com';

    public function execute(): string
    {
        $random = $this->_util()->random;
        $ds_u_user = $this->_infra::ds(DS::DS_U_USER);
        do {
            $random_key = $random::key(10, 10);
            $model = $ds_u_user->findByPublicId($random_key);
        } while ($model);
        return $random_key . '@' . self::MAIL_DOMAIN;
    }
}
