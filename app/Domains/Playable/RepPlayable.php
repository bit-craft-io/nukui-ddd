<?php

declare(strict_types=1);

namespace App\Domains\Playable;

use App\DataSources\Ds;
use App\DataSources\DsUPlayables;
use App\Domains\BaseEnt;
use App\Domains\BaseRep;
use App\Libraries\Exceptions\ExException;
use App\Libraries\Shared\SharedIterator;

/**
 * @method EntPlayable reCreate(array $model = [])
 * @method EntPlayable worker(array $model = [])
 * @method DsUPlayables ds()
 */
class RepPlayable extends BaseRep
{
    // @note 単一責任の原則にて Repository の DataSource は 1つ
    /** @var string|null  */
    protected ?string $_ds_type = Ds::U_PLAYABLE;

    // @note EntIterator<EntPlayable> の記述により Iterator の型補完が効く
    /**
     * @return SharedIterator
     * @throws ExException
     */
    public function getPlayables(): SharedIterator
    {
        return $this->_ents($this->ds()->devGet());
    }

    /**
     * @param int $id
     * @return EntPlayable|BaseEnt
     * @throws ExException
     */
    public function findOrFailedById(int $id): EntPlayable|BaseEnt
    {
        return $this->_ent($this->ds()->findOrFailedById($id));
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

    /**
     * @param array<BaseEnt> $entities
     * @return int
     */
    public function persists(array $entities): int
    {
        // TODO: coding persist() method.
        //$entity->getNickName();
        return 0;
    }
}
