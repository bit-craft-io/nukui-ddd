<?php

declare(strict_types=1);

namespace App\Domains\VOs;

/**
 * VoBaseType
 *
 * @property-read string $_type_category
 *
 * Voクラス継承先の LibInit
 * @method init(array $param)
 */
//class VoBaseType
//{
//    protected string $_type_category = '';
//    protected array $_type_maps = [];
//
//    /**
//     * @param int $type_id
//     * @return string
//     */
//    public function getNameOrEmptyByTypeId(int $type_id): string
//    {
//        return $this->_type_maps[$type_id] ?? '';
//    }
//
//    /**
//     * @param bool $is_index_key
//     * @return array
//     */
//    public function getIdToTypeObjects(bool $is_index_key = false): array
//    {
//        $collect = collect($this->_type_maps)
//            ->map(fn ($name, $id) => [
//                'type_id' => $id,
//                'type_name' => $name,
//            ]);
//        return $is_index_key ? $collect->toArray() : $collect->values()->toArray();
//    }
//
//    /**
//     * @return array
//     */
//    public function getIdToTypeMaps(): array
//    {
//        return collect($this->_type_maps)
//            ->mapWithKeys(fn ($name, $id): array => [$id => $name])
//            ->toArray();
//    }
//
//    public function getTypeCategory(): string
//    {
//        return $this->_type_category;
//    }
//}
