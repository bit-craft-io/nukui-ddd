<?php

declare(strict_types=1);

namespace App\Domains\Guild;

use App\DataSources\Ds;
use App\DataSources\DsUGuilds;
use App\Domains\BaseEnt;
use App\Domains\BaseRep;
use App\Libraries\Shared\SharedIterator;

/**
 * @method EntGuild reCreate(array $model = [])
 * @method EntGuild worker(array $model = [])
 * @method DsUGuilds ds()
 */
class RepGuild extends BaseRep
{
    // @note 単一責任の原則にて Repository の DataSource は 1つ
    /** @var string|null  */
    protected ?string $_ds_type = Ds::U_GUILD;

    // @note EntIterator<EntPlayable> の記述により Iterator の型補完が効く
    /**
     * @return SharedIterator<EntGuild>
     */
    public function getGuilds(): SharedIterator
    {
        return $this->_ents($this->ds()->devGet());
    }

    /**
     * @param BaseEnt $entity
     * @return void
     */
    public function persist(BaseEnt $entity): void
    {
        $origin = $entity->getToModelData();
        $entity->commit();
        if (array_diff($entity->getToModelData(), $origin)) {
            $this->ds()->upsert($entity->getToModelData());
        }
    }
}
