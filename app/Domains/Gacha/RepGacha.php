<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\Repository\BaseRep;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;
use App\Domains\EntHub;

class RepGacha extends BaseRep
{
    /**
     * @param int $user_id
     * @return EntGacha
     */
    public function find(int $user_id): EntGacha
    {
        $model = $this->_Infra::ds(DsHub::DS_U_GACHA)->findByUserId($user_id);
        return $this->_Domain::ent(EntHub::ENT_GACHA)->init($model);
    }

    /**
     * @return StfInsIterator<VoMGacha>|null
     */
    public function getVoMGacha(): ?StfInsIterator
    {
        $models = $this->_Infra::ds(DsHub::DS_M_GACHA)->getEnable();
        return $this->_Domain::voIterator(VoHub::VO_M_GACHA, $models, 'id');
    }
}
