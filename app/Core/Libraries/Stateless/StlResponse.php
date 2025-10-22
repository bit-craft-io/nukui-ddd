<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless;

use App\Core\Libraries\Stateful\Static\StfStaResponseModify;
use App\Core\Libraries\Stateful\Static\StfStaResponseParam;

/**
 * @property-read StfStaResponseParam $param
 * @property-read StfStaResponseModify $modify
 */
final class StlResponse
{
    private array $_classes = [
        'param' => StfStaResponseParam::class,
        'modify' => StfStaResponseModify::class,
    ];

    public function __get(string $name)
    {
        return $this->_classes[$name];
    }
}
