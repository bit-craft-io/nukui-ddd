<?php

namespace App\Models\Enums;


enum TypePlayStyle: int
{
    case SOLO = 1;
    case ENJOY = 2;
    case GACHI = 3;
    case COLLECTOR = 4;

    public function label(): string
    {
        return match ($this) {
            self::SOLO => 'ソロ',
            self::ENJOY => 'エンジョイ',
            self::GACHI => 'ガチ',
            self::COLLECTOR => '収集家',
        };
    }

    public function isSolo(): bool
    {
        return $this === self::SOLO;
    }
}
