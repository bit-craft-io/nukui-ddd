<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateless\Static;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Cache;

final class StlStaFakeNow
{
    private static int $_fake_now_expire_sec = 60;

    /**
     * @param int $user_id
     * @param string $fake_at
     * @return void
     */
    public static function setFakeNow(int $user_id, string $fake_at): void
    {
        if (!Carbon::canBeCreatedFromFormat($fake_at, 'Y-m-d H:i:s')) {
            return;
        }
        $fake_date_time = DateTime::createFromFormat('Y-m-d H:i:s', $fake_at);
        $offset_sec = $fake_date_time->getTimestamp() - time();
        Cache::set(self::_key($user_id), $offset_sec, self::$_fake_now_expire_sec);
    }

    /**
     * @param int $user_id
     * @return DateTime
     */
    public static function getFakeNow(int $user_id): DateTime
    {
        $offset = intval(Cache::get(self::_key($user_id)) ?? 0);
        if ($offset !== 0) {
            return new DateTime("+{$offset} seconds");
        }
        return new DateTime();
    }

    /**
     * @param int $user_id
     * @return void
     */
    public static function applyFakeNow(int $user_id): void
    {
        $offset = intval(Cache::get(self::_key($user_id)) ?? 0);
        if ($offset !== 0) {
            $fakeNow = new DateTime("+{$offset} seconds");
            Carbon::setTestNow($fakeNow);
            CarbonImmutable::setTestNow($fakeNow);
        }
    }

    /**
     * @param int $user_id
     * @return string
     */
    private static function _key(int $user_id): string
    {
        return "user_fake_offset_sec::$user_id";
    }
}
