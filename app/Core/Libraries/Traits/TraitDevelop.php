<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Stateless\Static\StlStaDevelopTool;

trait TraitDevelop
{
    public string|StlStaDevelopTool $_DevTool = StlStaDevelopTool::class;
}
