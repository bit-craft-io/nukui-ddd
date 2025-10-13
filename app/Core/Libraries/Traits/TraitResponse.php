<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Libraries\Utils\UtilGlobals;

trait TraitResponse
{
    const string PREFIX_KEY_RES = 'res::';
    const string PREFIX_KEY_MOD = 'mod::';

    private function param(string $key, $value): void
    {
        UtilGlobals::set(self::PREFIX_KEY_RES . $key, $value);
    }

    protected function _param(string $key)
    {
        return UtilGlobals::find(self::PREFIX_KEY_RES . $key);
    }

    protected function _allParam()
    {
        //self::PREFIX_KEY_RES . $key
        return UtilGlobals::find();
    }

    private function modify(string $key, $value): void
    {
        UtilGlobals::set(self::PREFIX_KEY_MOD . $key, $value);
    }

    protected function _modify(string $key)
    {
        return UtilGlobals::find(self::PREFIX_KEY_MOD . $key);
    }
}
