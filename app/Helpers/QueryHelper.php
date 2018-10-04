<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.03.2018
 * Time: 6:32
 */

namespace App\Helpers;


class QueryHelper
{
    private static $columns = [];

    public static function init($columns)
    {
        self::$columns = $columns;
    }

    public static function getModelColumns($model, $qualified = false)
    {
        $table = $model->getModel()->getTable();
        return self::getTableColumns($table, $qualified);
    }

    public static function getTableColumns($table, $qualified = false)
    {
        $cols = [];
        if (is_string($qualified))
            $qualified .= '.';
        elseif ($qualified)
            $qualified = $table . '.';
        else
            $qualified = '';
        foreach (self::$columns[$table] as $col) {
            $cols[] = $table . '.' . $col . ' as ' . $qualified . $col;
        }
        return $cols;
    }
}