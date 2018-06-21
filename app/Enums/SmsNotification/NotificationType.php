<?php

namespace App\Enums\SmsNotification;

use App\Enums\HasNullKey;
use BenSampo\Enum\Enum;

final class NotificationType extends Enum
{
    use HasNullKey;
    const NEW = 0;
    const PRE = 1;
    const POST = 2;

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription(int $value): string
    {
        switch ($value) {
            case self::NEW:
                return 'После оформления';
                break;
            case self::PRE:
                return 'Напоминание о приеме';
                break;
            case self::POST:
                return 'Для отзыва';
                break;
            default:
                return self::getKey($value);
        }
    }
}
