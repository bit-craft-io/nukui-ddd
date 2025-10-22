<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Stateless\Static\StlStaRandom;
use App\Core\Libraries\Traits\TraitInfra;
use App\DataSources\DS;

class UcMakePublicId
{
    use TraitInfra;

    public function execute(): string
    {
        do {
            $random_key = StlStaRandom::key(4, 5);
            $model = $this->_infra::ds(DS::DS_U_USER)->findByPublicId($random_key);
        } while ($model);
        return $random_key;
    }
}
