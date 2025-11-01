<?php

declare(strict_types=1);

namespace App\Domains\Gacha;

use App\Core\Domains\Entity\BaseEnt;
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

    public function draft($user_id)
    {
        $model = $this->_Infra::ds(DsHub::DS_U_GACHA)->getDraft($user_id);
        return $this->_Domain::ent(EntHub::ENT_GACHA)->init($model);
    }

    public function persist(EntGacha|BaseEnt $ent): void
    {
        $ent->commit();
        if ($ent->isNew()) {
            $this->_Infra::ds(DsHub::DS_U_GACHA)->create($ent->getProperties());

        } else {
            $this->_Infra::ds(DsHub::DS_U_GACHA)->update($ent->getProperties(), ['user_id' => $ent->user_id]);
        }
    }
}
