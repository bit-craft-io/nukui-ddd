<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\DataSources\DsHub;
use App\Domains\EntHub;

class RepAccount extends BaseRep
{
    /**
     * @return EntAccount|BaseEnt
     */
    public function makeDraft(): EntAccount|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_ACCOUNT)->getDraft();
        return $this->_Domain::ent(EntHub::ENT_ACCOUNT)->init($model);
    }

    /**
     * @param EntAccount|BaseEnt $ent
     * @return void
     */
    public function persist(EntAccount|BaseEnt $ent): void
    {
        $ent->commit();
        $id = $this->_Infra::ds(DsHub::DS_ACCOUNT)->createGetId($ent->getProperties());

        $ent->id($id);
        $ent->commit();
    }
}
