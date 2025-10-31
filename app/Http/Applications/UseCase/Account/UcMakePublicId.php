<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitInfrastructure;
use App\Core\Libraries\Traits\TraitUtil;
use App\DataSources\DsHub;

final class UcMakePublicId
{
    use TraitInfrastructure;
    use TraitUtil;

    public function execute(): string
    {
        $ds_u_user = $this->_Infra::ds(DsHub::DS_U_USER);
        do {
            // TODO 処理コストを確認 $this->_util()->random
            $random_key = $this->_UtilRandom::key32(4, 5);
            $model = $ds_u_user->findByPublicId($random_key);
        } while ($model);
        return $random_key;
    }
}
