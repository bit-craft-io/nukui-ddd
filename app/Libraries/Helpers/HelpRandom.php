<?php

declare(strict_types=1);

namespace App\Libraries\Helpers;

final class HelpRandom
{
    public static function key(int $number_digits = 5, int $char_digits = 5): string
    {
        $numbers = range(0, 9);
        $chars = range('a', 'z');

        shuffle($numbers);
        $lot_number = array_slice($numbers, 0, $number_digits);

        shuffle($chars);
        $lot_char = array_slice($chars, 0, $char_digits);

        $lot_merged = array_merge($lot_number, $lot_char);
        shuffle($lot_merged);
        return implode('', $lot_merged);
    }

    public static function key32(int $number_digits = 5, int $char_digits = 5): string
    {
        $numbers = str_split('23456789');
        $chars = str_split('abcdefghijkmnpqrstuvwxyz');

        shuffle($numbers);
        $lot_number = array_slice($numbers, 0, $number_digits);

        shuffle($chars);
        $lot_char = array_slice($chars, 0, $char_digits);

        $lot_merged = array_merge($lot_number, $lot_char);
        shuffle($lot_merged);
        return implode('', $lot_merged);
    }
}
