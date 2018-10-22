<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:33
 */

namespace App\Components\Longrid;

use App\Components\Longrid\Items\BaseItem;

class Column
{
    public $items = [];
    public $container;
    public $width;
    public function __construct($column,$container)
    {

        foreach ($column->items as $key=> $item){
            array_push($this->items,new BaseItem($item,$this));
        }
        $this->width = $column->width;
        $this->container = $container;
    }

    /**
     * @return ColumnContainer
     */
    public function parent()
    {
        return $this->container;
    }

    public function inspectItem()
    {
        /**
         *   @var $item BaseItem
         */

        foreach($this->items as $key => $item){
            $name = "App\Components\Longrid\Items\\".ucfirst($item->type);

            $item = new $name($item,$item->column);
            $item->inspectSelf();
            $this->items[$key] = $item;
        }

    }

    public function prependItem($item)
    {
        array_unshift($this->items,$item);
    }

    public function getHtmlBlock()
    {
      return Grid::renderBlock('column',[
            'column' => $this
        ],$this->parent()->parent()->parent()->template);
    }

    public function appendItem($item){
        array_unshift($this->items,$item);
    }
}