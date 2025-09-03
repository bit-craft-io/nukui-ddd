<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\ExStreamHandler;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Monolog\Handler\StreamHandler;

/**
 * AppServiceProvider
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton('_isException', function (): bool {
            return false;
        });
        app()->bind(StreamHandler::class, function ($app) {
            return new ExStreamHandler('php://stderr', config('logging.level', 'debug'));
        });
        //request()->macro('Request', function (): ExRequest {
        //    return app(ExRequest::class);
        //});
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
