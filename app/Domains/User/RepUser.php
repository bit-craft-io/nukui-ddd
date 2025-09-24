<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\Repository\BaseRep;

class RepUser extends BaseRep
{
    public function findByPublicId(string $public_id): EntUser|BaseEnt
    {
        $model = $this->_ds(DSs::DS_U_USER)->findByPublicId($public_id);
        return $this->_ent($model);
    }

    /**
     * @return EntUser|BaseEnt
     */
    public function draft(): EntUser|BaseEnt
    {
//        // TODO
//        $this->_ds(self::DS_U_USER)->dummy();

        $model = $this->_ds(DSs::DS_U_USER)->getDraft();
        return $this->_ent($model);
    }

    public function persist(EntUser|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(DSs::DS_U_USER)->insert($ent->getProperties());
    }
}
