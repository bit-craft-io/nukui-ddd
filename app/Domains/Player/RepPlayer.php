<?php

namespace App\Domains\Player;

use App\DataSources\Ds;
use App\DataSources\DsUPlayers;
use App\Domains\BaseEnt;
use App\Domains\BaseRep;
use App\Libraries\Shared\SharedIterator;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * @method EntPlayer reCreate(Model $model = [])
 * @method EntPlayer worker(Model $model = [])
 * @method DsUPlayers ds()
 */
class RepPlayer extends BaseRep
{
    protected ?string $_ds_type = Ds::U_PLAYER;

    /**
     * @return SharedIterator<EntPlayer>
     */
    public function getPlayers(): SharedIterator
    {
        return $this->_ents($this->ds()->get());
    }

    /**
     * @param int $id
     * @return EntPlayer
     * @throws Exception
     */
    public function findPlayer(int $id): EntPlayer
    {
        return $this->_ent($this->ds()->find($id));
    }

    /**
     * @param BaseEnt $entity
     * @return void
     */
    public function persist(BaseEnt $entity): void
    {
        $origin = $entity->getProperties();
        $entity->commit();
        if (array_diff($entity->getProperties(), $origin)) {
            $this->ds()->upsert($entity->getProperties());
        }
    }
}
