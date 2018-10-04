<?php

namespace App\Enums\Comment;

use BenSampo\Enum\Enum;

final class CommentStatus extends Enum
{
    const MODERATION = 0;
    const VISIBLE = 1;
    const DELETED = 2;

    public static $DESCRIPTIONS = [
        0 => 'Модерация',
        1 => 'Допущенный',
        2 => 'Закрытый'
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
