<?php

declare(strict_types=1);

namespace App\Http\Responses\Core;

use App\Libraries\Utils\UtilInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ModifyRes
{
    private static ?BaseRes $response = null;

    public static function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = UtilInstance::singleton($response_class);
        self::$response = $response;
    }

    public static function find(Request $request): ?BaseRes
    {
        return self::$response;
    }
}
