<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\DataSources\DS;

class RepUser extends BaseRep
{
    /**
     * @return EntUser|BaseEnt
     */
    public function makeDraft(): EntUser|BaseEnt
    {
        $model = $this->_ds(DS::DS_U_USER)->getDraft();
        return $this->_ent($model);
    }
    public function findByPublicId(string $public_id): EntUser|BaseEnt
    {
        $model = $this->_ds(DS::DS_U_USER)->findByPublicId($public_id);
        return $this->_ent($model);
    }
    public function findByUserId(int $user_id): EntUser|BaseEnt
    {
        $model = $this->_ds(DS::DS_U_USER)->findByUserId($user_id);
        return $this->_ent($model);
    }

    public function persist(EntUser|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(DS::DS_U_USER)->insert($ent->getProperties());
    }
}
