<?php

declare(strict_types=1);

namespace App\Domains\Core\Entity;

use App\Libraries\Traits\TraitDataSource;
use App\Libraries\Traits\TraitValueObject;
use App\Libraries\Utils\UtilIterator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEnt
{
    use TraitDataSource;
    use TraitValueObject;

    // @note HlpInstanceからクラス生成時に不変の値を設定
    abstract public function initOnce(): void;
    abstract public function initAfter(): void;
    protected ?Model $_model = null;
    protected array $_draft = [];
    protected array $_draft_keys = [];

    public function init(?Model $model): self
    {
        $this->_model = $model;
        $this->initAfter();
        return $this;
    }

    public function __get(string $name)
    {
        return $this?->_model?->{$name};
    }

    public function __call(string $name, array $arguments = [])
    {
        $this->_draft[$name] = $arguments[0];
        $this->_draft_keys[] = $name;
        return $this;
    }

    public function commit(): void
    {
        //$this->_model->forceFill($this->_draft);
        $this->_model->fill($this->_draft);
        $this->_draft = [];
    }

    public function getProperties(): array
    {
        return $this->_model->toArray();
    }

    public function iterator($collect): UtilIterator
    {
        $callable = function ($model) {
            if ($model && method_exists($this, 'init')) {
                $this->init($model);
            }
            return $this;
        };
        $iterator = app(UtilIterator::class);
        $iterator->init($callable, $collect);
        return $iterator;
    }
}
