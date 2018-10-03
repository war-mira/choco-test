<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.03.2018
 * Time: 17:43
 */

namespace App\Helpers;


class ConstraintBuilder
{
    protected static $tablesMap = [
        'Doctor' => 'doctors'
    ];
    private $constraints = [];
    private $table = '';
    private $column = false;


    public function __construct($table)
    {
        $this->table = $table;
    }

    public static function __callStatic($name, $arguments)
    {
        $builder = new ConstraintBuilder($arguments[0]);
        return $builder;
    }

    public function __get($name)
    {
        if (!$this->column)
            $this->column = $name;
        return $this;
    }

    public function __call($name, $arguments)
    {
        if ($name == 'contains')
            $this->constraints = [$this->table . '.' . $this->column, 'like', '%' . $arguments[0] . '%'];
        return $this->constraints;

    }
}