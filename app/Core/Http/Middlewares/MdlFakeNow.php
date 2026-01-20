<?php

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitApplication;
use Closure;

final class MdlFakeNow
{
    use TraitApplication;

    public function handle($request, Closure $next)
    {
        if ($this->_Config::app()->debug && auth()->check()) {
            $this->_Date::applyFakeNow(auth()->id());
        }
        return $next($request);

    }
}
