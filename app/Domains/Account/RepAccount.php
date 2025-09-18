<?php

declare(strict_types=1);

namespace App\Domains\Account;

use App\Domains\BaseEnt;
use App\Domains\BaseRep;

class RepAccount extends BaseRep
{
    public function draft(): EntAccount|BaseEnt
    {
        $model = $this->_ds(self::DS_ACCOUNT)->getDraft();
        return $this->_ent($model);
    }

    public function persist(EntAccount|BaseEnt $ent): void
    {
        /** @var  */
        $ent->commit();
        $id = $this->_ds(self::DS_ACCOUNT)->insertGetId($ent->getProperties());

        $ent->_id($id);
        $ent->commit();
    }
}
