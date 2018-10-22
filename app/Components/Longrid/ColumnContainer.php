<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 15:18
 */

namespace App\Components\Longrid;

class ColumnContainer
{
    public $columns = [];
    public $row;
    public $additionalRow = false;
    public $additionalRowType = 'default';
    public $additionalRowContent = '';
    public $type = 'default';
    public function __construct($columns,$row)
    {

        foreach ($columns as $column){
            array_push($this->columns,new Column($column,$this));
        }
        $this->row = $row;
    }
    /**
     * @return Row
     */
    public function parent()
    {
        return $this->row;
    }
}