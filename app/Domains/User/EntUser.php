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
        // TODO VOの処理を作成中
        //dd($this->energy);
        $this->_vo_energy = $this->_vo(VoEnergy::class)->init(['energy' => $this->energy]);

        $temp = $this->_vo_energy->energy;
        //dd($temp + 10);
        //$this->_vo_energy->energy($temp + 10);

        $this->_vo_energy->energy($temp + 10);
        //dd($this->_vo_energy->energy);
        dd($this->energy);
        //->init(['energy' => $this->energy]);
    }

    public function getEnergy(): int
    {
        $this->_vo_energy->energy($this->_vo_energy->energy + 10);
        dd(__LINE__);
        return $this->_vo_energy->energy;
    }

    public function isEmpty(): bool
    {
        return ($this->id ?? 0) != 0;
    }
}
