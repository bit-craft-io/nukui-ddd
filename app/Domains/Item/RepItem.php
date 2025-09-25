<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\DataSources\DSs;
use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\Repository\BaseRep;
use App\Libraries\Utils\UtilIterator;

class RepItem extends BaseRep
{
    public function makeDraft(int $user_id, int $item_id): EntItem|BaseEnt
    {
        $model = $this->_ds(DSs::DS_U_ITEM)->getDraft();
        $model->fill(['user_id' => $user_id, 'item_id' => $item_id]);
        return $this->_ent($model);
    }

    /**
     * @param int $user_id
     * @return UtilIterator<EntItem|BaseEnt>
     */
    public function getByUserId(int $user_id): UtilIterator
    {
        $models = $this->_ds(DSs::DS_U_ITEM)->getByUserId($user_id);
        return $this->_ent()->iterator($models);
    }

    public function persist(EntItem|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(DSs::DS_U_ITEM)->upsert($ent->getProperties());
    }
}
