<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

use App\Core\Http\Responses\BaseRes;

final class StfStaResponseModify
{
    protected static ?BaseRes $_response = null;

    public static function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = StfStaInstance::singleton($response_class);
        self::$_response = $response;
    }

    public static function find(): ?BaseRes
    {
        return self::$_response;
    }
}
