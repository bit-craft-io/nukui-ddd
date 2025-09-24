<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\ValueObject\VoEnergy;
use App\Libraries\Utils\UtilInstance;

/**
 * @method id(int $value)
 * @method public_id(string $value)
 * @method nick_name(string $value)
 * @method icon_no(string $value)
 * @method energy(int $value)
 * @method energy_max_regen(int $value)
 * @method energy_max_stock(int $value)
 * @method meta_data(object $value)
 * @property-read integer $id
 * @property-read string $public_id
 * @property-read string $nick_name
 * @property-read integer $icon_no
 * @property-read integer $energy
 * @property-read integer $energy_max_regen
 * @property-read integer $energy_max_stock
 * @property-read object $meta_data
 */
class EntUser extends BaseEnt
{
    public function initOnce(): void
    {
        // TODO: Implement initOnce() method.
    }

    public function getEnergy(): int
    {
        // TODO VO ファクトリ作成中（Trait?）初期化処理になるはず
        $voEnergy = UtilInstance::prototype(VoEnergy::class);
        $voEnergy->_props(['energy' => $this->energy]);
        dd($voEnergy);
        return $this->energy;
    }

    public function isEmpty(): bool
    {
        return ($this->id ?? 0) != 0;
    }
}
