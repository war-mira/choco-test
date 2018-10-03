<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.09.2017
 * Time: 15:15
 */

namespace App\Helpers;


class FormatHelper
{
    public static function phone($string)
    {
        $numstr = preg_replace("/[^0-9]/", "", $string);
        if (strlen($numstr) <= 0)
            $numstr = '7';
        if ($numstr[0] == '8')
            $numstr = '7' . substr($numstr, 1);
        if (strlen($numstr) > 11)
            $numstr = substr($numstr, 0, 11);
        else
            $numstr = str_pad($numstr, 11, '0', STR_PAD_RIGHT);
        return $numstr;
    }

    public static function jqSelectorName($name)
    {
        $search = ['.', '[', ']'];
        $replace = ['\\\\.', '\\\\[', '\\\\]'];
        return str_replace($search, $replace, $name);
    }

    public static function cyrToLat($str)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        $strRep = str_replace($cyr, $lat, $str);

        return $strRep;
    }

    public static function arrayToString($arr)
    {
      $string = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($arr), ENT_NOQUOTES));

      return $string;
    }

    public static function userShothDate($date){

        return date('Y-m-d', strtotime($date));
    }
}