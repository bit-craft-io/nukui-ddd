<?php

declare(strict_types=1);

namespace App\Domains\Item;

use App\Domains\Core\Entity\BaseEnt;

/**
 * @property-read integer $id
 * @property-read integer $user_id
 * @property-read integer $item_id
 * @property-read integer $amount
 * @property-read object $enabled_end_at
 */
class EntItem extends BaseEnt
{

    public function setDefaults(): void
    {
        // TODO: Implement setDefaults() method.
    }
}
