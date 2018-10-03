<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.03.2018
 * Time: 18:00
 */

namespace App\Helpers\DB;


class Where extends Constraint
{
    protected static $tablesMap = [
        'Doctor' => 'doctors'
    ];

    protected $operator;
    private $constraints = [];
    private $boolean = 'and';
    private $table = '';
    private $column = false;


    public function __construct($table, $operator = null)
    {
        $this->operator = $operator ?? 'where';
        $this->table = $table;
    }

    public static function __callStatic($name, $arguments)
    {
        $builder = new Where($arguments[0]);
        return $builder;
    }

    public function __get($name)
    {
        if (!$this->column)
            $this->column = $name;
        return $this;
    }

    private function flush()
    {
        $this->column = false;
        $this->operator = false;
    }

    private function getOperator()
    {
        return $this->boolean == 'and' ? $this->operator : 'or' . title_case($this->operator);
    }

    public function __call($name, $arguments)
    {
        if (!$this->column) {
            switch ($name) {
                case 'where':

                    break;
                case 'and':
                    break;
                case 'or':
                    $this->flush();
                    $this->boolean = 'or';
                    break;
                default:
                    break;

            }
        }
        $operator =
        if ($name == 'contains')
            $this->constraints[] = [, [$this->table . '.' . $this->column, 'like', '%' . $arguments[0] . '%']];
        return $this->constraints;

    }
}