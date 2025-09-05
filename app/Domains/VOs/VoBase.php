<?php

declare(strict_types=1);

namespace App\Domains\VOs;

use App\Models\MTypes;
use Exception;
use Illuminate\Support\Facades\Log;

///**
// * VoBase
// */
//class VoBase
//{
////    protected int $_value = 0;
//    protected string $_class = '';
//    protected array $_properties = [];
//    protected bool $_is_type = false;
//    protected array $_lazy_initialize_vos = [];
//
////    public function setValue(int &$value): void
////    {
////        $this->_value = &$value;
////    }
////
////    public function minus(): void
////    {
////        $this->_value -= 1;
////        Log::debug($this->_value);
////    }
//
////    public function __construct(string $class, array $properties)
////    {
////        $this->_class = $class;
////        $this->_properties = $properties;
////    }
//
//    public function __construct(string $class)
//    {
//        $this->_class = $class;
//    }
//
//    /**
//     * @param string $class
//     * @param array $properties
//     * @return array
//     */
//    private function _getTypeProperties(string $class, array $properties = []): array
//    {
//        $type_properties = [];
//        /** @var VoBaseType $instance */
//        $instance = app($class);
//        $type_category = $instance->getTypeCategory();
//        /** @var MTypes $m_types */
//        $m_types = app(MTypes::class);
//        $types = $m_types->getByTypeCategory($type_category);
//        if (!empty($types)) {
//            $type_maps = collect($types)
//                ->mapWithKeys(fn ($m_type) => [$m_type['type_id'] => $m_type['type_name']])
//                ->toArray();
//            $type_properties = compact('type_maps');
//            if (!empty($properties)) {
//                $type_properties += $properties;
//            }
//        }
//        return $type_properties;
//    }
//
//    /**
//     * @param string $class
//     * @return void
//     */
//    public function clear(): void
//    {
//        if (isset($this->_lazy_initialize_vos[$this->_class])) {
//            $this->_lazy_initialize_vos[$this->_class] = false;
//        }
//    }
//
//    private function _vo(string $class, array $properties = []): object
//    {
//        $this->_class = $class;
//        $this->_properties = $properties;
//
//    }
//
//    public function findType(): object
//    {
//        $this->_is_type = true;
//        return $this->find();
//    }
//
//    public function find(): object
//    {
//        if (empty($this->_lazy_initialize_vos[$this->_class])) {
//            if ($this->_is_type) {
//                $properties = $this->_getTypeProperties($this->_class, $this->_properties);
//            }
//            $instance = app($this->_class);
//            if (method_exists($instance, 'initialize')) {
//                return $instance->initialize($properties);
//            }
//            $this->_lazy_initialize_vos[$this->_class] = $instance;
//        }
//
//        if (is_null($this->_lazy_initialize_vos[$this->_class])) {
//            $class_basename = class_basename($this->_class);
//            throw app(Exception::class, ['message' => "is none [ $class_basename ]"]);
//        }
//
//        return $this->_lazy_initialize_vos[$this->_class];
//    }
//
//    /**
//     * @return void
//     */
//    public function flush(): void
//    {
//        $this->_lazy_initialize_vos[$this->_class] = null;
//    }
//
//    /**
//     * @return void
//     */
//    public function flushAll(): void
//    {
//        $this->_lazy_initialize_vos = [];
//    }
//}
