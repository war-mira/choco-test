<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const NEW = 0;
    const VISIT_CHECK = 1;
    const VISIT_SUCCESS = 2;
    const VISIT_FAIL = 3;
    const STATUS_4 = 4;
    const STATUS_5 = 5;
    const STATUS_6 = 6;
    const STATUS_7 = 7;
    const STATUS_8 = 8;
    const STATUS_9 = 9;
    const STATUS_10 = 10;
    const STATUS_11 = 11;
    const STATUS_12 = 12;
    const STATUS_13 = 13;
    const STATUS_14 = 14;
    const STATUS_15 = 15;
    const STATUS_16 = 16;
    const STATUS_17 = 17;
    const STATUS_18 = 18;
    const STATUS_19 = 19;
    const STATUS_20 = 20;
    const STATUS_21 = 21;
    const STATUS_22 = 22;
    const STATUS_23 = 23;
    const STATUS_24 = 24;

    public static $DESCRIPTIONS = [
        0  => 'Новый',
        1  => 'Проверить посещение',
        2  => 'Посетил',
        3  => 'Не посетил',
        4  => 'Записать',
        5  => 'Заявки',
        6  => 'Записать на прием',
        7  => 'Отказ',
        8  => 'Нет врача',
        9  => 'Не устроила цена',
        10 => 'Плохая локация',
        11 => 'Тест',
        12 => 'Нет ответа',
        13 => 'Повтор',
        14 => 'Другое',
        15 => 'В работе',
        16 => 'Лист ожидания',
        17 => 'Записался сам',
        18 => 'Не подходит по местоположению',
        19 => 'Ошибка номера',
        20 => 'Перевод на другого оператора',
        21 => 'Перевод на клинику',
        23 => 'Другой город',
        24 => 'Уточнение информации'
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
