<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful;

use App\Core\Libraries\Stateful\Static\StfStaDevelopLog;
use App\Core\Libraries\Stateful\Static\StfStaDevelopTool;

final class StfDevelop
{
    public string|StfStaDevelopLog $log = StfStaDevelopLog::class;
    public string|StfStaDevelopTool $tool = StfStaDevelopTool::class;
}
