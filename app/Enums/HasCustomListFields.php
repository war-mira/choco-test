<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.03.2018
 * Time: 3:05
 */

namespace App\Enums;


trait HasCustomListFields
{
    abstract function getTable();

    public function listVal($column)
    {
        $table = $this->getTable();
        $value = $this[$column];

        $list = CustomList::query()
            ->where([
                ['table', '=', $table],
                ['column', '=', $column]
            ])->firstOrFail();
        $listValue = $list->values()->where('id', $value)->firstOrFail();
        return $listValue;
    }
}