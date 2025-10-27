<?php

declare(strict_types=1);

namespace App\Core\DataSources;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Database\Eloquent\Model;

abstract class BaseDs
{
    protected ?CarbonImmutable $_now = null;
    protected ?Model $_model = null;

    final public function _now(): CarbonImmutable
    {
        // @note 意図しない動作を抑止する為 Carbon ではなく CarbonImmutable を使用
        if ($this->_now == null) {
            $this->_now = CarbonImmutable::now();
        }
        return $this->_now;

    }

    /**
     * @template T
     * @param Model<T> $model
     * @return void
     */
    final public function _model(Model $model): void
    {
        $this->_model = $model;
    }

    /**
     * @param array $values
     * @return void
     */
    final public function insert(array $values): void
    {
        $this->_model
            ->newQuery()
            ->insert($values);
    }

    /**
     * @param array $values
     * @param array $conditions
     * @return void
     */
    final public function update(array $values, array $conditions): void
    {
        $this->_model
            ->newQuery()
            ->where($conditions)
            ->update($values);
    }

    /**
     * @param array $values
     * @return int
     */
    final public function insertGetId(array $values): int
    {
        return $this->_model
            ->newQuery()
            ->insertGetId($values);
    }

    final public function enable(?string $column_begin = null, ?string $column_end = null): Closure
    {
        $now = $this->_now();
        return function ($query) use ($now, $column_begin, $column_end) {
            $query->where(function ($query) use ($now, $column_begin, $column_end): void {
                $query->whereNull($column_begin)
                    ->orWhere($column_begin, '<=', $now);
            });
            $query->where(function ($query) use ($now, $column_begin, $column_end): void {
                $query->whereNull($column_end)
                    ->orWhere($column_end, '>=', $now);
            });
        };
    }
}
