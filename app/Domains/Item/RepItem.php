<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DS;
use App\Domains\Ent;

class RepItem extends BaseRep
{
    public function makeDraft(int $user_id, int $item_id): EntItem|BaseEnt
    {
        $model = $this->_infra::ds(DS::DS_U_ITEM)->getDraft();
        $model->fill(['user_id' => $user_id, 'item_id' => $item_id]);
        return $this->_domain::ent(Ent::ENT_ITEM)->init($model);
    }

    /**
     * @param int $user_id
     * @return StfInsIterator<EntItem|BaseEnt>
     */
    public function getByUserId(int $user_id): StfInsIterator
    {
        $models = $this->_infra::ds(DS::DS_U_ITEM)->getByUserId($user_id);
        return $this->_domain::ent(Ent::ENT_ITEM)->iterator($models, 'item_id');
    }

    public function persist(EntItem|BaseEnt $ent): void
    {
        //$ent->commit();
        //$ent->upsert();
        // @note 型のキャスト（$casts）の設定は upsert は有効にならない
        //       この為、upsert 以外のやり方で永続化
        $ent->commit();
        if ($ent->isNew()) {
            $this->_infra::ds(DS::DS_U_ITEM)->insert($ent->getProperties());
        } else {
            $this->_infra::ds(DS::DS_U_ITEM)->update($ent->getProperties(), ['user_id' => $ent->user_id, 'item_id' => $ent->item_id]);
        }
    }
}
