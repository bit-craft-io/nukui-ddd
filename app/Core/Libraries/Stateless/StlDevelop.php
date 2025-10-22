<?php

namespace App\Core\Libraries\Stateless;

use App\Core\Libraries\Stateful\Static\StfStaDevelopLog;
use App\Core\Libraries\Stateful\Static\StfStaDevelopTool;

/**
 * @property-read StfStaDevelopLog $log
 * @property-read StfStaDevelopTool $tool
 */
class StlDevelop
{
    private array $_classes = [
        'log' => StfStaDevelopLog::class,
        'tool' => StfStaDevelopTool::class
    ];

    public function __get(string $name)
    {
        return $this->_classes[$name];
    }
}
