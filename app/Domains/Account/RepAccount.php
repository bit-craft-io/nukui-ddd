<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\Repository\BaseRep;

class RepAccount extends BaseRep
{
    public function draft(): EntAccount|BaseEnt
    {
        $model = $this->_ds(DSs::DS_ACCOUNT)->getDraft();
        return $this->_ent($model);
    }

    public function persist(EntAccount|BaseEnt $ent): void
    {
        /** @var  */
        $ent->commit();
        $id = $this->_ds(DSs::DS_ACCOUNT)->insertGetId($ent->getProperties());

        $ent->id($id);
        $ent->commit();
    }
}
