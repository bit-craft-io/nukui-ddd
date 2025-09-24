<?php

declare(strict_types=1);

namespace App\Domains\Core\Entity;

use App\Libraries\Traits\TraitDataSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseEnt
{
    use TraitDataSource;

    // @note HlpInstanceからクラス生成時に不変の値を設定
    abstract public function setDefaults(): void;
    protected ?Model $_model = null;
    protected array $_draft = [];
    protected array $_draft_keys = [];

    public function _model(?Model $model): void
    {
        $this->_model = $model;
    }

    public function __get(string $name)
    {
        return $this?->_model?->{$name};
    }

    public function __call(string $member_name, array $arguments = [])
    {
        $snake_case = Str::snake($member_name);
        if ('_' === $snake_case[0]) {
            $key = substr($snake_case, 1);
            $this->_draft[$key] = $arguments[0];
            $this->_draft_keys[] = $key;
        }
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
}
