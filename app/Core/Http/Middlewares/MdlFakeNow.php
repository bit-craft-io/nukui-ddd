<?php

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\Core\Libraries\Traits\TraitCore;
use App\Core\Libraries\Traits\TraitUtil;
use Closure;

final class MdlFakeNow
{
    use TraitCore;
    use TraitUtil;
    use TraitInfra;
    use TraitDomain;

    public function handle($request, Closure $next)
    {
        if ($this->_Config::app()->debug && auth()->check()) {
            $this->_Date::applyFakeNow(auth()->id());
        }
        return $next($request);

    }
}
