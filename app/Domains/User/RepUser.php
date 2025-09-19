<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Domains\BaseEnt;
use App\Domains\BaseRep;

class RepUser extends BaseRep
{
    public function findByPublicId(string $public_id): EntUser|BaseEnt
    {
        $model = $this->_ds(self::DS_U_USER)->findByPublicId($public_id);
        return $this->_ent($model);
    }

    public function draft(): EntUser|BaseEnt
    {
        $model = $this->_ds(self::DS_U_USER)->getDraft();
        return $this->_ent($model);
    }

    public function persist(EntUser|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(self::DS_U_USER)->insert($ent->getProperties());
    }
}
