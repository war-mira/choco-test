<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MedicalServiceType extends Enum
{

    const SERVICE = 0;
    const CATEGORY = 1;

    public static $DESCRIPTIONS = [
        0 => 'Услуга',
        1  => 'Категория',
    ];

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription(int $value): string
    {
        return self::$DESCRIPTIONS[$value] ?? self::getKey($value);
    }
}
