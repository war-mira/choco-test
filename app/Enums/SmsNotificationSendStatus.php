<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SmsNotificationSendStatus extends Enum
{
    const ERROR = -1;
    const NONE = 0;
    const WAITING = 1;
    const SENT = 2;

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription(int $value): string
    {
        switch ($value) {
            case self::ERROR:
                return 'Ошибка';
                break;
            case self::NONE:
                return '-';
                break;
            case self::WAITING:
                return 'Ожидание';
                break;
            case self::SENT:
                return 'Отправлено';
                break;
            default:
                return self::getKey($value);
        }
    }
}
