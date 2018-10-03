<?php

namespace App\Enums\Post;

use BenSampo\Enum\Enum;

final class PostStatus extends Enum
{


    const HIDDEN = 0;
    const VISIBLE = 1;
    const DELETED = 2;

    public static $DESCRIPTIONS = [
        0  => 'Скрыт',
        1  => 'Опубликован',
        2  => 'Удален'
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
