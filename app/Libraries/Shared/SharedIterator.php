<?php

namespace App\Libraries\Shared;

use Illuminate\Database\Eloquent\Collection;
use Iterator;

/**
 * @template T
 */
final class SharedIterator implements Iterator
{
    /**
     * @var callable
     */
    protected $_worker = null;
    protected ?Collection $_models = null;
    protected array $_keys = [];
    protected int $_position = 0;

    /**
     * @return mixed
     */
    private function _key(): mixed
    {
        return $this->_keys[$this->_position];
    }

    /**
     * @param callable $worker
     * @param Collection $models
     * @return void
     */
    public function init(callable $worker, Collection $models): void
    {
        $this->_worker = $worker;
        $this->_models = $models;
        $this->_keys = $models->pluck('id')->all();
        $this->rewind();
    }

    /**
     * @return T
     */
    public function find($key): mixed
    {
        if (isset($this->_keys[$key])) {
            $model = $this->_models->find($this->_keys[$key]);
            return call_user_func($this->_worker, $model);
        }
        return null;
    }

    /**
     * @return T
     */
    public function current(): mixed
    {
        $model = $this->_models->find($this->_key());
        return call_user_func($this->_worker, $model);
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
        return $this->_position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->_models[$this->_position]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->_position = 0;
    }
}
