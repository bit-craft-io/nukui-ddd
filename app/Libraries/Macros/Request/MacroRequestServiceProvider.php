<?php

declare(strict_types=1);

namespace App\Libraries\Macros\Request;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class MacroRequestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Request::macro('Request', function (): ExRequest {
            return app(ExRequest::class);
        });
    }
}
