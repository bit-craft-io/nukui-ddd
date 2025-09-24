<?php

namespace App\Models\Enums;

enum TypeItem: int
{
    case consumable = 1;
    case permanent  = 2;
    case equipment  = 3;
    case material   = 4;
    public function label(): string
    {
        return match($this) {
            self::consumable => '消耗アイテム',
            self::permanent  => '永続アイテム',
            self::equipment  => '装備アイテム',
            self::material   => '素材アイテム',
        };
    }

    public function isConsumable(): bool
    {
        return $this === self::consumable;
    }

    public function isPermanent(): bool
    {
        return $this === self::permanent;
    }

    public function isEquipment(): bool
    {
        return $this === self::equipment;
    }

    public function isMaterial(): bool
    {
        return $this === self::material;
    }
}
