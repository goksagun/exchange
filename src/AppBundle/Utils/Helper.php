<?php

namespace AppBundle\Utils;

class Helper
{
    /**
     * Convert a value to studly caps case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function studly($value)
    {
        $studlyCache = [];
        $key = $value;

        if (isset($studlyCache[$key])) {
            return $studlyCache[$key];
        }

        $value = ucwords(str_replace(array('-', '_'), ' ', $value));

        return $studlyCache[$key] = str_replace(' ', '', $value);
    }

    /**
     * Convert a value to title case.
     *
     * @param string $value
     * @return string
     */
    public static function titleCase($value)
    {
        $value = preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', static::studly($value));

        return trim(ucwords($value));
    }
}