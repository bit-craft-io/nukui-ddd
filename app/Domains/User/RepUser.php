<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\Repository\BaseRep;

class RepUser extends BaseRep
{
    /**
     * @return EntUser|BaseEnt
     */
    public function makeDraft(): EntUser|BaseEnt
    {
        $model = $this->_ds(DSs::DS_U_USER)->getDraft();
        return $this->_ent($model);
    }
    public function findByPublicId(string $public_id): EntUser|BaseEnt
    {
        $model = $this->_ds(DSs::DS_U_USER)->findByPublicId($public_id);
        return $this->_ent($model);
    }
    public function findByUserId(int $user_id): EntUser|BaseEnt
    {
        $model = $this->_ds(DSs::DS_U_USER)->findByUserId($user_id);
        return $this->_ent($model);
    }

    public function persist(EntUser|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(DSs::DS_U_USER)->insert($ent->getProperties());
    }
}
