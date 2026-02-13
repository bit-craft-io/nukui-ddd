<?php

declare(strict_types=1);

namespace App\Http\Applications\UseCase\Account;

use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\Core\Libraries\Traits\TraitCore;
use App\Core\Libraries\Traits\TraitUtil;
use App\DataSources\DsHub;

final class UcMakePublicId
{
    use TraitCore;
    use TraitUtil;
    use TraitInfra;
    use TraitDomain;

    /**
     * @return string
     */
    public function execute(): string
    {
        $ds_u_user = $this->_DataSource::make(DsHub::DS_U_USER);
        do {
            // TODO 処理コストを確認 $this->_util()->random
            $random_key = $this->_UtilRandom::key32(4, 5);
            $model = $ds_u_user->findByPublicId($random_key);
        } while ($model);
        return $random_key;
    }
}
