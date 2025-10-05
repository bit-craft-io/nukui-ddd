<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Helpers\HelperRandom;
use App\Core\Libraries\Traits\TraitDataSource;
use App\DataSources\DS;

class UcMakePublicId
{
    use TraitDataSource;

    public function execute(): string
    {
        do {
            $random_key = HelperRandom::key(4, 5);
            $model = $this->_ds(DS::DS_U_USER)->findByPublicId($random_key);
        } while ($model);
        return $random_key;
    }
}
