<?php

declare(strict_types=1);

namespace App\_Demo\Domains\DemoItem;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\Repository\BaseRep;
use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\_Demo\DataSources\DsHub;
use App\_Demo\Domains\EntHub;
use App\_Demo\Domains\DemoItem\EntDemoItem;

class RepDemoItem extends BaseRep
{
    public function makeDraft(int $user_id, int $item_id): EntDemoItem|BaseEnt
    {
        $model = $this->_Infra::ds(DsHub::DS_M_DEMO_ITEM)->getDraft();
        $model->fill(['user_id' => $user_id, 'item_id' => $item_id]);
        return $this->_Domain::ent(EntHub::ENT_DEMO_ITEM)->init($model);
    }

    /**
     * @param int $user_id
     * @return StfInsIterator<EntDemoItem|BaseEnt>
     */
    public function getByUserId(int $user_id): StfInsIterator
    {
        $models = $this->_Infra::ds(DsHub::DS_U_DEMO_ITEM)->getByUserId($user_id);
        return $this->_Domain::ent(EntHub::ENT_DEMO_ITEM)->iterator($models, 'item_id');
    }

    public function persist(EntDemoItem|BaseEnt $ent): void
    {
        $ent->commit();
        if ($ent->isNew()) {
            $this->_Infra::ds(DsHub::DS_U_DEMO_ITEM)->create($ent->getProperties());
        } else {
            $this->_Infra::ds(DsHub::DS_U_DEMO_ITEM)->update($ent->getProperties(), ['user_id' => $ent->user_id, 'item_id' => $ent->item_id]);
        }
    }
}
