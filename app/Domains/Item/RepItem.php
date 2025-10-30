<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\Core\Domains\ValueObject\VoMItem;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\DataSources\DsHub;
use App\Domains\EntHub;
use Exception;

class RepItem extends BaseRep
{
    /**
     * @param int $user_id
     * @param int $item_id
     * @return EntItem|BaseEnt
     */
    public function makeDraft(int $user_id, int $item_id): EntItem|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_U_ITEM)->getDraft();
        $model->fill(['user_id' => $user_id, 'item_id' => $item_id]);
        return $this->_Domain::ent(EntHub::ENT_ITEM)->init($model);
    }

    /**
     * @param int $user_id
     * @param int $item_id
     * @return EntItem|BaseEnt
     * @throws Exception
     */
    public function findOrFail(int $user_id, int $item_id): EntItem|BaseEnt
    {
        $conditions = ['user_id' => $user_id, 'item_id' => $item_id];
        $model = $this->_Infra::ds(DsHub::DS_U_ITEM)->findOrFail($conditions);
        return $this->_Domain::ent(EntHub::ENT_ITEM)->init($model);
    }

    /**
     * @param int $user_id
     * @return StfInsIterator<EntItem|BaseEnt>
     */
    public function getByUserId(int $user_id): StfInsIterator
    {
        $models = $this->_Infra::ds(DsHub::DS_U_ITEM)->getByUserId($user_id);
        return $this->_Domain::entIterator(EntHub::ENT_ITEM, $models, 'item_id');
    }

    /**
     * @param EntItem|BaseEnt $ent
     * @return void
     */
    public function persist(EntItem|BaseEnt $ent): void
    {
        // @note 型のキャスト（$casts）の設定は upsert は有効にならない
        //       この為、upsert 以外のやり方で永続化
        $ent->commit();
        //$ent->upsert();
        if ($ent->isNew()) {
            $this->_Infra::ds(DsHub::DS_U_ITEM)->create($ent->getProperties());
        } else {
            $this->_Infra::ds(DsHub::DS_U_ITEM)->update($ent->getProperties(), ['user_id' => $ent->user_id, 'item_id' => $ent->item_id]);
        }
    }
}
