<?php

declare(strict_types=1);

namespace App\Libraries\Macros\Response;

use App\Libraries\Macros\Request\ExRequest;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class MacroResponseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Response::macro('Response', function (): ExResponse {
            return app(ExResponse::class);
        });
    }
}
