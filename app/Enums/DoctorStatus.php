<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DoctorStatus extends Enum
{
    const BLOCK = -1;
    const HIDDEN = 0;
    const VISIBLE = 1;
    const MODERATION = 2;
    const STATIC = 3;
    const SYSTEM = 4;

    public static $DESCRIPTIONS = [
        -1 => 'Заблокирован',
        0  => 'Скрыт',
        1  => 'Опубликован',
        2  => 'Модерация',
        3  => 'Статичный',
        4  => 'Системный'
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
