<?php

declare(strict_types=1);

namespace App\UseCase\Account;

use App\DataSources\DSs;
use App\Libraries\Helpers\HelpRandom;
use App\Libraries\Traits\TraitDataSource;

class UcMakeEmail
{
    use TraitDataSource;

    const string MAIL_DOMAIN = 'example.com';

    public function execute(): string
    {
        do {
            $random_key = HelpRandom::key(10, 10);;
            $model = $this->_ds(DSs::DS_U_USER)->findByPublicId($random_key);
        } while ($model);
        return $random_key . '@' . self::MAIL_DOMAIN;
    }
}
