<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.02.2018
 * Time: 13:36
 */

namespace App\Enums\Order;


use App\Enums\HasNullKey;
use BenSampo\Enum\Enum;

class NotifyType extends Enum
{
    use HasNullKey;

    const NONE = 0;
    const SMS = 2;
    const EMAIL = 3;
    const SMS_EMAIL = 1;

    /**
     * Get the description for an enum value
     *
     * @param  int $value
     * @return string
     */
    public static function getDescription(int $value): string
    {
        switch ($value) {
            case self::NONE:
                return 'Не отправлять';
                break;
            case self::SMS:
                return 'SMS';
                break;
            case self::EMAIL:
                return 'Email';
                break;
            case self::SMS_EMAIL:
                return 'SMS + Email';
                break;
            default:
                return self::getKey($value);
        }
    }
}