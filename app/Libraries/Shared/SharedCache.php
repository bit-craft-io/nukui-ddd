<?php

declare(strict_types=1);

namespace App\Libraries\Shared;

use Closure;
use DateInterval;
use Illuminate\Support\Facades\Cache;

class SharedCache extends Cache
{
    private string $_remember_key = '';
    private bool $_is_cast_int = false;
    private int $_remember_expire_min = 600;
    /**
     * @param string $remember_key
     * @return void
     */
    public function setRememberKey(string $remember_key): void
    {
        $this->_remember_key = $remember_key;
    }

    /**
     * @param bool $is_cast_int
     * @return void
     */
    public function setIsCastInt(bool $is_cast_int): void
    {
        $this->_is_cast_int = $is_cast_int;
    }

    /**
     * @param callable $callback
     * @return mixed
     */
    public function find(callable $callback): mixed
    {
        $key = $this->_remember_key;
        $ttl = $this->_remember_expire_min;
        $cache = Cache::remember($key, $ttl, $callback);
        if ($this->_is_cast_int && is_numeric($cache)) {
            return (int)$cache;
        }
        return $cache;
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        Cache::flush();
    }

    /**
     * @param mixed $value
     * @param int|DateInterval|null $ttl
     * @return void
     */
    public function fSet(mixed $value, null|int|DateInterval $ttl = null): void
    {
        Cache::set($this->_remember_key, $value, $ttl);
    }

    /**
     * @param Closure|null $default
     * @return mixed
     */
    public function fGet(null|Closure $default = null): mixed
    {
        return Cache::get($this->_remember_key, $default);
    }
}
