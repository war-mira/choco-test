<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 12:37
 */

namespace App\Helpers;


class MathHelper
{
    /**
     * Расчет рейтинга на основе шкалы голосов
     *
     * @param $sumVotes Сумма всех голосов
     * @param $totalVotes Кол-во голосов
     * @param array $votesRange Диапазон возможных значений голосов
     * @return float|int
     */
    public static function wilsonScore($sumVotes, $totalVotes, $votesRange = [0, 2, 4, 8, 10])
    {
        if ($sumVotes > 0 && $totalVotes > 0) {
            $z = 1.64485;
            $vMin = min($votesRange);
            $vWidth = floatval(max($votesRange) - $vMin);
            $phat = ($sumVotes - $totalVotes * $vMin) / $vWidth / floatval($totalVotes);
            $rating = ($phat + $z * $z / (2 * $totalVotes) - $z * sqrt(($phat * (1 - $phat) + $z * $z / (4 * $totalVotes)) / $totalVotes)) / (1 + $z * $z / $totalVotes);
            return round($rating * $vWidth + $vMin, 6);
        }
        return 0;
    }
}