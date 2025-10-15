<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\Core\Libraries\Stateful\Static\StfStaIterator;
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
     * @return StfStaIterator<EntItem|BaseEnt>
     */
    public function getByUserId(int $user_id): StfStaIterator
    {
        $models = $this->_ds(DS::DS_U_ITEM)->getByUserId($user_id);
        return $this->_ent()->iterator($models);
    }

    public function persist(EntItem|BaseEnt $ent): void
    {
        // @note 型のキャスト（$casts）の設定は upsert は有効にならない
        //       この為、他のやり方で永続化
        // TODO 他のやり方
        $ent->commit();
        if ($ent->isNew()) {
            // TODO 動作確認
            $this->_ds(DS::DS_U_ITEM)->insert($ent->getProperties());
        } else {
            // TODO 動作確認
            $this->_ds(DS::DS_U_ITEM)->update($ent->getProperties());
        }
    }
}
