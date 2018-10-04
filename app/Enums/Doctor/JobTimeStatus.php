<?php

namespace App\Enums\Doctor;

use BenSampo\Enum\Enum;

final class JobTimeStatus extends Enum
{
    const DISABLED = 0;
    const ENABLED = 1;

    public static $DESCRIPTIONS = [
        0 => 'Неактивно',
        1 => 'Активно'
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
