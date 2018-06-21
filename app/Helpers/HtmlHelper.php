<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.10.2017
 * Time: 9:57
 */

namespace App\Helpers;


class HtmlHelper
{
    public static $STR_LEN = 16;

    public static function id(&$id)
    {
        if ($id == null || !is_string($id)) {
            $id = str_random(self::$STR_LEN);
        }

        return ' id="' . $id . '" ';
    }


}