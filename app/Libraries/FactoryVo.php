<?php

declare(strict_types=1);

namespace App\Libraries;

use App\Libraries\Shared\SharedHelper;
use Exception;

class FactoryVo
{
    protected array $_lazy_initialize_vos = [];

    /**
     * @param string $class
     * @param array $arguments
     * @return object
     */
    protected function _create(string $class, array $arguments = []): object
    {
        $instance = SharedHelper::prototype($class);
        // TODO 値を設定するメソッドあったかな？
        if (method_exists($instance, 'initialize')) {
            $instance->initialize($arguments);
        }
        return $instance;
    }

    /**
     * @param string $class
     * @return void
     */
    public function clear(string $class): void
    {
        if (isset($this->_lazy_initialize_vos[$class])) {
            $this->_lazy_initialize_vos[$class] = false;
        }
    }

    /**
     * @param string $class
     * @param array $arguments
     * @return object
     * @throws Exception
     */
    public function find(string $class, array $arguments = []): object
    {
        if (empty($this->_lazy_initialize_vos[$class])) {
            // TODO プロトタイプで作成しているので$properties はfindの外で渡す様にしよう
            $this->_lazy_initialize_vos[$class] = $this->_create($class, $arguments);
        }
        if (is_null($this->_lazy_initialize_vos[$class])) {
            $class_basename = class_basename($class);
            throw new Exception("Class '$class_basename' not found");
        }
        return $this->_lazy_initialize_vos[$class];
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->_lazy_initialize_vos = [];
    }
}
