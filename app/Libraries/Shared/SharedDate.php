<?php

declare(strict_types=1);

namespace App\Libraries\Shared;

use Carbon\Carbon;

/**
 * ExCarbon
 */
final class SharedDate
{
    protected static Carbon $_carbon;

    public static function load()
    {
        if (app()->has(self::class)) {
            app()->singleton(self::class);
            self::$_carbon = Carbon::createFromTimestampUTC(request()->server('REQUEST_TIME') ?? time());
            self::$_carbon->setTimezone('Asia/Tokyo');
        }
        return app(self::class);
    }

    //public function getFileTimeStamp(int $add_days = 0): string
    //{
    //    return (clone $this->_carbon)->addDays($add_days)->format('Ymd_His');
    //}
    //
    ///**
    // * @param int $add_days
    // * @return string
    // */
    //public function getExecYmdHms(int $add_days = 0): string
    //{
    //    return (clone $this->_carbon)->addDays($add_days)->format('Y-m-d H:i:s');
    //}
    //
    ///**
    // * @param int $add_months
    // * @return string
    // */
    //public function getPasswordGenLimited(int $add_months = 3): string
    //{
    //    return (clone $this->_carbon)->addMonths($add_months)->format('Y-m-d H:i:s');
    //}
    //
    ///**
    // * @param int $add_minutes
    // * @return string
    // */
    //public function getTempUrlParamLimitedAt(int $add_minutes = 30): string
    //{
    //    return (clone $this->_carbon)->addMinutes($add_minutes)->format('Y-m-d H:i:s');
    //}
    //
    ///**
    // * @param int $add_days
    // * @return string
    // */
    //public function getTokenExpiresAt(int $add_days = 0): string
    //{
    //    return $this->getExecYmdHms($add_days);
    //}
    //
    ///**
    // * @param string $date_a
    // * @param string $date_b
    // * @return bool
    // */
    //public function between(string $date_a, string $date_b): bool
    //{
    //    return $this->_carbon->gte($date_a) && $this->_carbon->lte($date_b);
    //}
    //
    ///**
    // * @param string $date
    // * @return bool
    // */
    //public function isAfter(string $date): bool
    //{
    //    return $this->_carbon->isAfter($date);
    //}
    //
    ///**
    // * @param string $date
    // * @return bool
    // */
    //public function isBefore(string $date): bool
    //{
    //    return $this->_carbon->isBefore($date);
    //}
    //
    ///**
    // * @param bool $have_than_equal
    // * @param ...$params
    // * @return bool
    // */
    //public function hasCorrectOrder(bool $have_than_equal = true, ...$params): bool
    //{
    //    if (count($params) <= 1) {
    //        return true;
    //    }
    //
    //    $pre = array_shift($params);
    //    $compare = $have_than_equal
    //        ? fn ($pre, $param) => $pre <= $param
    //        : fn ($pre, $param) => $pre < $param;
    //
    //    foreach ($params as $param) {
    //        if ($compare($pre, $param)) {
    //            $pre = $param;
    //            continue;
    //        }
    //        return false;
    //    }
    //    return true;
    //}
}
