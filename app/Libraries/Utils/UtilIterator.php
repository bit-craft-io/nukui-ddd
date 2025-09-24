<?php

namespace App\Libraries\Utils;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Iterator;

/**
 * @template T
 */
final class UtilIterator implements Iterator
{
    /** @var callable|null  */
    protected $_callable = null;
    protected ?Collection $_models = null;
    protected array $_keys = [];
    protected int $_position = 0;
//    /** @var array<self> */
//    protected static array $_prototype = [];
//
//    public static function prototype()
//    {
//        $class = static::class;
//        if (!app()->has($class)) {
//            app()->singleton($class);
//            self::$_prototype[$class] = app()->make($class);
//            // @note $_callable 作成時の prototype で initOnce を実行済
//            //$this->_prototype->initOnce();
//        }
//        return clone self::$_prototype[$class];
//    }

    /**
     * @return mixed
     */
    private function _key(): mixed
    {
        return $this->_keys[$this->_position] ?? null;
    }

    /**
     * @template K of Model
     * @param callable $callable
     * @param Collection<K> $models
     * @param string $keyName
     * @return void
     */
    public function init(callable $callable, Collection $models, string $keyName = 'id'): void
    {
        $this->_callable = $callable;
        $this->_models = $models->keyBy($keyName);
        $this->_keys = $this->_models->keys()->all();
        $this->rewind();
    }

    /**
     * @param $key
     * @return T|null
     */
    public function find($key): mixed
    {
        /** @var T|null $model */
        $model = $this->_models->get($key) ?? null;
        if ($model) {
//            dd($this->_callable, $model);
            return call_user_func($this->_callable, $model);
        }
        return null;
    }

    /**
     * @return T
     */
    public function current(): mixed
    {
        /** @var T|null $model */
        $model = $this->_models->get($this->_key());
        return call_user_func($this->_callable, $model);
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->_position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        //return $this->_position;
        return $this->_key();
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->_models[$this->_key()]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->_position = 0;
    }
}
