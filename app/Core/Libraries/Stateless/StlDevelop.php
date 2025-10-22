<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless;

use App\Core\Libraries\Stateless\Static\StlStaDevelopLog;
use App\Core\Libraries\Stateless\Static\StlStaDevelopTool;

final class StlDevelop
{
    public string|StlStaDevelopLog $log = StlStaDevelopLog::class;
    public string|StlStaDevelopTool $tool = StlStaDevelopTool::class;
}
