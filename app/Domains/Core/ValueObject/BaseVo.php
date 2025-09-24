<?php

declare(strict_types=1);

namespace App\Domains\Core\ValueObject;

use App\Libraries\Utils\UtilInstance;
use App\Libraries\Utils\UtilIterator;
use Illuminate\Database\Eloquent\Model;

class BaseVo
{
//    protected ?array $_props = null;
//
//    public function _props(array $props)
//    {
//        $this->_props = $props;
//    }
//
//    public function __get(string $name)
//    {
//        return $this?->_props[$name] ?? null;
//    }
//
//    public function iterator($models): UtilIterator
//    {
//        $callable = function ($props) {
//            if ($props && method_exists($this, '_props')) {
//                $this->_props($props->toArray());
//            }
//            return $this;
//        };
//        // TODO prototype の処理が重複
//        $iterator = UtilInstance::prototype(UtilIterator::class);
//        $iterator->init($callable, $models);
//        return $iterator;
//    }
    protected ?Model $_model = null;

    public function _model(?Model $model): void
    {
        $this->_model = $model;
    }

    public function __get(string $name)
    {
        return $this?->_model?->{$name};
    }

    public function iterator($models): UtilIterator
    {
        $callable = function ($model) {
            if ($model && method_exists($this, '_model')) {
                $this->_model($model);
            }
            return $this;
        };
        // TODO prototype の処理が重複
        $iterator = UtilInstance::prototype(UtilIterator::class);
        $iterator->init($callable, $models);
        return $iterator;
    }
}
