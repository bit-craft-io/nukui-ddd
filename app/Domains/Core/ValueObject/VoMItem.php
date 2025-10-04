<?php

declare(strict_types=1);

namespace App\Domains\Core\ValueObject;

use App\Models\Enums\TypeItem;

/**
 * @property-read integer $id
 * @property-read string $name
 * @property-read TypeItem $type_item
 * @property-read integer $max_display
 * @property-read integer $max_stock
 * @property-read object $enabled_from_at
 * @property-read object $enabled_end_at
 */
class VoMItem extends BaseVo
{

}
