<?php

declare(strict_types=1);

namespace App\Core\Libraries\Traits;

use App\Core\Http\Responses\BaseRes;
use App\Core\Libraries\Stateful\Static\StlStaResponseParam;
use App\Core\Libraries\Stateful\Static\StfStaResponseModify;

trait TraitResponse
{
    ///**
    // * @return class-string<StlStaResponseParam>
    // */
    //protected function _PARAM(): string
    //{
    //    return StlStaResponseParam::class;
    //}
    //
    ///**
    // * @return class-string<StfStaResponseModify>
    // */
    //protected function _MODIFY(): string
    //{
    //    return StfStaResponseModify::class;
    //}

    //protected static array $_param = [];
    //public static function _responseParamSet(string $key, $value = null): void
    //{
    //    self::$_param[$key] = $value;
    //}

    protected function _responseParamSet(string $key, $value): void
    {
        StlStaResponseParam::set($key, $value);
    }

    protected function _responseParamFind(string $key)
    {
        return StlStaResponseParam::find($key);
    }

    protected function _responseParamAll(): array
    {
        return StlStaResponseParam::all();
    }

    protected function _responseModifySet(string $response_class): void
    {
        StfStaResponseModify::set($response_class);
    }

    protected function _responseModifyFind(): ?BaseRes
    {
        return StfStaResponseModify::find();
    }
}
