<?php

namespace App\Utils;

class SearchNormalizer
{
    public static function normalize(string $value): string
    {
        $value = mb_strtolower($value, 'UTF-8');

        $replace = [
            'á' => 'a',
            'é' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ú' => 'u',
            'ä' => 'a',
            'ë' => 'e',
            'ï' => 'i',
            'ö' => 'o',
            'ü' => 'u',
            'ñ' => 'n',
        ];

        return strtr($value, $replace);
    }
}
