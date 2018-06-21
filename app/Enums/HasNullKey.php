<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.02.2018
 * Time: 22:39
 */

namespace App\Enums;


trait HasNullKey
{
    public static function get($value)
    {
        if (isset($value) && is_int($value)) {
            return self::getDescription($value);
        } else {
            return null;
        }
    }
}