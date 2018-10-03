<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.03.2018
 * Time: 13:57
 */

namespace App\Enums;


use Carbon\Carbon;

class WeekTime
{
    public static function getDayName($id)
    {
        return ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'][$id];
    }

    public static function getDateTimeId(Carbon $dateTime)
    {
        $startOfWeek = $dateTime->copy()->startOfWeek();
        $timeId = $dateTime->diffInMinutes($startOfWeek) / 30;
        return $timeId;
    }

    public static function forDay($day)
    {
        $times = [];
        $startId = $day * 48;
        for ($i = $startId; $i < $startId + 48; $i++) {
            $times[] = self::get($i);
        }
        return $times;
    }

    public static function get($id)
    {
        $dayId = self::getTimesDayId($id);
        $dayMinutes = ($id % 48) * 30;
        return [
            'id'       => $id,
            'day_id'   => $dayId,
            'day_name' => self::getDayName($dayId),
            'day_time' => Carbon::create(0, 0, 0, intval($dayMinutes / 60), intval($dayMinutes % 60))->format('H:i')
        ];
    }

    public static function getTimesDayId($timeId)
    {
        return (int)($timeId / 48);
    }

    public static function byDays()
    {
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = [
                'day_id'   => $i,
                'day_name' => self::getDayName($i),
                'times'    => self::forDay($i)
            ];
        }
        return $days;
    }
}