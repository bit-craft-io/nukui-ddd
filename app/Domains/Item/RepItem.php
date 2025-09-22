<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\Repository\BaseRep;

class RepItem extends BaseRep
{
    public function findByUserId(int $user_id): EntItem|BaseEnt
    {
        $model = $this->_ds(self::DS_U_ITEM)->findByUserId($user_id);
        return $this->_ent($model);
    }
}
