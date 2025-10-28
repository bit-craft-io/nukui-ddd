<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\DataSources\DsHub;
use App\Domains\EntHub;

class RepUser extends BaseRep
{
    /**
     * @return EntUser|BaseEnt
     */
    public function makeDraft(): EntUser|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_U_USER)->getDraft();
        return $this->_Domain::ent(EntHub::ENT_USER)->init($model);
    }

    /**
     * @param string $public_id
     * @return EntUser|BaseEnt
     */
    public function findByPublicId(string $public_id): EntUser|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_U_USER)->findByPublicId($public_id);
        return $this->_Domain::ent(EntHub::ENT_USER)->init($model);
    }

    /**
     * @param int $user_id
     * @return EntUser|BaseEnt
     */
    public function findByUserId(int $user_id): EntUser|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_U_USER)->findByUserId($user_id);
        return $this->_Domain::ent(EntHub::ENT_USER)->init($model);
    }

    /**
     * @param EntUser|BaseEnt $ent
     * @return void
     */
    public function persist(EntUser|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_Infra::ds(DsHub::DS_U_USER)->create($ent->getProperties());
    }
}
