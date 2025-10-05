<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\DataSources\DS;

class RepAccount extends BaseRep
{
    public function mekDraft(): EntAccount|BaseEnt
    {
        $model = $this->_ds(DS::DS_ACCOUNT)->getDraft();
        return $this->_ent($model);
    }

    public function persist(EntAccount|BaseEnt $ent): void
    {
        /** @var  */
        $ent->commit();
        $id = $this->_ds(DS::DS_ACCOUNT)->insertGetId($ent->getProperties());

        $ent->id($id);
        $ent->commit();
    }
}
