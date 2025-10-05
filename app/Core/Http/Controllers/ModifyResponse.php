<?php

declare(strict_types=1);

namespace App\Core\Http\Controllers;

use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Utils\UtilInstance;
use Illuminate\Http\Request;

final class ModifyResponse
{
    private static ?BaseRes $response = null;

    public static function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = UtilInstance::singleton($response_class);
        self::$response = $response;
    }

    public static function find(): ?BaseRes
    {
        return self::$response;
    }
}
