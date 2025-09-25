<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Domains\Core\Entity\BaseEnt;
use App\Domains\Core\ValueObject\VoEnergy;

/**
 * @method void id(int $value)
 * @method void public_id(string $value)
 * @method void nick_name(string $value)
 * @method void icon_no(string $value)
 * @method void energy(int $value)
 * @method void energy_max_regen(int $value)
 * @method void energy_max_stock(int $value)
 * @method void meta_data(object $value)
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
    protected VoEnergy $_vo_energy;

    public function initOnce(): void
    {
        // TODO: Implement initOnce() method.
    }

    public function initAfter(): void
    {
        // @note $this（entity）を渡す、voの値を変更すると entity の値も変わる（draft）
        $this->_vo_energy = $this->_vo(VOs::VO_ENERGY)->init($this);
    }

    //public function getEnergy(): int
    //{
    //    return $this->energy;
    //}

    public function addEnergy(int $value): void
    {
        $this->_vo_energy->recover($value);
    }

    public function subEnergy(int $value): void
    {
        $this->_vo_energy->consume($value);
    }

    public function isEmpty(): bool
    {
        return ($this->id ?? 0) != 0;
    }
}
