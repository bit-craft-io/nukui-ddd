<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

final class StlStaCompress
{
    public static function comp(string $value): string
    {
        return base64_encode(gzcompress($value));
    }

    public static function unComp(string $value): string
    {
        return gzuncompress(base64_decode($value));
    }
}
