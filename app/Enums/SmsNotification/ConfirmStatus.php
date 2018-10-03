<?php

namespace App\Enums\SmsNotification;

use App\Enums\HasNullKey;
use BenSampo\Enum\Enum;

final class ConfirmStatus extends Enum
{
    use HasNullKey;
    const CANCEL = -1;
    const NONE = 0;
    const CONFIRM = 1;

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::CANCEL:
                return 'Отменено';
                break;
            case self::NONE:
                return '-';
                break;
            case self::CONFIRM:
                return 'Подтверждено';
                break;
            default:
                return (string) self::getKey($value);
        }
    }
}
