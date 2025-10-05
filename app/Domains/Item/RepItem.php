<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\Core\Libraries\Utils\UtilIterator;
use App\DataSources\DS;

class RepItem extends BaseRep
{
    public function makeDraft(int $user_id, int $item_id): EntItem|BaseEnt
    {
        $model = $this->_ds(DS::DS_U_ITEM)->getDraft();
        $model->fill(['user_id' => $user_id, 'item_id' => $item_id]);
        return $this->_ent($model);
    }

    /**
     * @param int $user_id
     * @return UtilIterator<EntItem|BaseEnt>
     */
    public function getByUserId(int $user_id): UtilIterator
    {
        $models = $this->_ds(DS::DS_U_ITEM)->getByUserId($user_id);
        return $this->_ent()->iterator($models);
    }

    public function persist(EntItem|BaseEnt $ent): void
    {
        $ent->commit();
        $this->_ds(DS::DS_U_ITEM)->upsert($ent->getProperties());
    }
}
