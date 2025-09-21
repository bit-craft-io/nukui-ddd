<?php

declare(strict_types=1);

namespace App\UseCase\Account;

use App\Libraries\Helpers\HelpRandom;
use App\Libraries\Traits\TraitDataSource;

class UcMakePublicId
{
    use TraitDataSource;

    public function execute(): string
    {
        do {
            $random_key = HelpRandom::key(4, 5);
            $model = $this->_ds(self::DS_U_USER)->findByPublicId($random_key);
        } while ($model);
        return $random_key;
    }
}
