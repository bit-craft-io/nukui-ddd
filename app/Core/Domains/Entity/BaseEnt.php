<?php

declare(strict_types=1);

namespace App\Core\Domains\Entity;

use App\Core\Libraries\Stateful\Instance\StfInsIterator;
use App\Core\Libraries\Stateful\Static\StfStaFactory;
use App\Core\Libraries\Traits\TraitDomain;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read integer $id
 */
abstract class BaseEnt
{
    use TraitDomain;

    // @note クラス生成時に１回だけ実行される
    abstract public function initOnce(): void;
    // @note 初期化後に実行される
    abstract public function initAfter(): void;
    protected ?Model $_model = null;
    protected array $_draft = [];
    protected array $_draft_keys = [];

    /**
     * @param Model|null $model
     * @return $this
     */
    public function init(?Model $model): self
    {
        $this->_model = $model;
        if ($this->_model) {
            $this->initAfter();
        }
        return $this;
    }

    /**
     * 値を取得（型キャストはModelのcastsを参照）
     *
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this?->_model?->{$name};
    }

    /**
     * 値を仮変更
     *
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    public function __call(string $name, array $arguments = [])
    {
        $this->_draft[$name] = $arguments[0];
        $this->_draft_keys[] = $name;
        return $this;
    }

    /**
     * 値を仮変更から本変更
     *
     * @return void
     */
    public function commit(): void
    {
        $this->_model->fill($this->_draft);
        $this->_draft = [];
    }

    /**
     * 現在値を取得
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->_model->toArray();
    }

    /**
     * イテレータを取得
     *
     * @param Collection $collect
     * @param string $key_name
     * @return StfInsIterator
     */
    public function iterator(Collection $collect, string $key_name = 'id'): StfInsIterator
    {
        $callable = function ($model) {
            if ($model && method_exists($this, 'init')) {
                $this->init($model);
            }
            return $this;
        };
        $class = StfStaFactory::prototype(StfInsIterator::class);
        $class->init($callable, $collect, $key_name);
        return $class;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id ?? null);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->_model ?? null);
    }
}
