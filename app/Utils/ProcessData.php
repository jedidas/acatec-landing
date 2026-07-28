<?php

namespace App\Utils;


class ProcessData
{
    public function validateJsonString(string $jsonString, string $key): ?array
    {
        // Try to decode the JSON string into an associative array
        $array = json_decode($jsonString, true);

        // Check if the decoding was successful and if the array has at least one element
        if ($array === null || !is_array($array) || count($array) === 0) {
            return null;
        }

        // Check that the first element has the specified key
        $firstElement = $array[0];
        if (!array_key_exists($key, $firstElement)) {
            return null;
        }

        // Build the array with the values of the specified key
        $values = array_column($array, $key);

        // Everything is fine, return the array of values
        return $values;
    }

    public function extractValuesByKey(array $array, string $key): array
    {
        $values = [];
        foreach ($array as $object) {
            if (isset($object[$key])) {
                $values[] = $object[$key];
            }
        }
        return $values;
    }

    public static function normalizeSearch(string $value): string
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
