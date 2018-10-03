<?php

namespace App\Enums\SmsNotification;

use App\Enums\HasNullKey;
use BenSampo\Enum\Enum;

final class SendStatus extends Enum
{
    use HasNullKey;
    const ERROR = -1;
    const NONE = 0;
    const SENT = 1;

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::ERROR:
                return 'Ошибка';
                break;
            case self::NONE:
                return '-';
                break;
            case self::SENT:
                return 'Отправлено';
                break;
            default:
                return self::getKey($value);
        }
    }

    public static function get($value)
    {
        if (isset($value) && is_int($value)) {
            return self::getDescription($value);
        } else {
            return null;
        }
    }
}
