<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

use App\Core\Http\Responses\BaseRes;

final class StfStaResponseModify
{
    protected static ?BaseRes $_response = null;

    /**
     * @param string $response_class
     * @return void
     */
    public static function set(string $response_class): void
    {
        /** @var BaseRes $response */
        $response = StfStaFactory::singleton($response_class);
        self::$_response = $response;
    }

    /**
     * @return BaseRes|null
     */
    public static function find(): ?BaseRes
    {
        return self::$_response;
    }
}
