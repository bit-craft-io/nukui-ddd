<?php

declare(strict_types=1);

namespace App\Domains\User;

use App\Domains\Core\Entity\BaseEnt;

/**
 * @method _id(int $value)
 * @method _public_id(string $value)
 * @method _nick_name(string $value)
 * @method _icon_no(string $value)
 * @method _energy(int $value)
 * @method _energy_max_regen(int $value)
 * @method _energy_max_stock(int $value)
 * @method _meta_data(object $value)
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

    public function setDefaults(): void
    {
        // TODO: Implement setDefaults() method.
    }

    public function isEmpty(): bool
    {
        return ($this->id ?? 0) != 0;
    }
}
