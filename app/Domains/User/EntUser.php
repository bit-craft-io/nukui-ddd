<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Core\Domains\Entity\BaseEnt;
use App\Core\Domains\ValueProxy\VpEnergy;

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
    protected VpEnergy $_vp_energy;

    public function initOnce(): void
    {
        // TODO: Implement initOnce() method.
    }

    public function initAfter(): void
    {
        // @note $this（entity）を渡す、voの値を変更すると entity の値も変わる（draft）
        //$this->_vp_energy = $this->_vo(VpUser::VP_ENERGY)->init($this);
        $this->_vp_energy = $this->_Domain::vo(VpHub::VP_ENERGY)->init($this);
    }

    //public function getEnergy(): int
    //{
    //    return $this->energy;
    //}

    public function addEnergy(int $value): void
    {
        $this->_vp_energy->recover($value);
    }

    public function subEnergy(int $value): void
    {
        $this->_vp_energy->consume($value);
    }

    public function isEmpty(): bool
    {
        return ($this->id ?? 0) == 0;
    }

    public function toArray(): array
    {
        return [
            'public_id' => $this->public_id,
            'nick_name' => $this->nick_name,
            'icon_no' => $this->icon_no,
            'energy' => $this->energy,
        ];
    }
}
