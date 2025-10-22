<?php

declare(strict_types=1);

namespace App\Core\Libraries\Stateful\Static;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Iterator;

/**
 * @template T
 */
final class StfStaIterator implements Iterator
{
    /** @var callable|null  */
    private $_callable = null;
    private ?Collection $_models = null;
    private array $_keys = [];
    private int $_position = 0;

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
     * @param string $key_name
     * @return void
     */
    public function init(callable $callable, Collection $models, string $key_name = 'id'): void
    {
        $this->_callable = $callable;
        $this->_models = $models->keyBy($key_name);
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
        //dd($this->_models->toArray());
        if ($model) {
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
