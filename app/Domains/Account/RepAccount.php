<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\DataSources\DS;
use App\Domains\Ent;

class RepAccount extends BaseRep
{
    public function mekDraft(): EntAccount|BaseEnt
    {
        $model = $this->_Infra::ds(DS::DS_ACCOUNT)->getDraft();
        return $this->_Domain::ent(Ent::ENT_ACCOUNT)->init($model);
    }

    public function persist(EntAccount|BaseEnt $ent): void
    {
        /** @var  */
        $ent->commit();
        $id = $this->_Infra::ds(DS::DS_ACCOUNT)->insertGetId($ent->getProperties());

        $ent->id($id);
        $ent->commit();
    }
}
