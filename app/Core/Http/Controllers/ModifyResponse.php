<?php

declare(strict_types=1);

namespace App\Core\Http\Controllers;

use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Stateful\Static\StfStaInstance;

final class ModifyResponse
{
    private static ?BaseRes $response = null;

    public static function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = StfStaInstance::singleton($response_class);
        self::$response = $response;
    }

    public static function find(): ?BaseRes
    {
        return self::$response;
    }
}
