<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:33
 */

namespace App\Components\Longrid;




class Row
{
    public $grid;
    public $container;
    protected $index;
    public function __construct($row,$grid,$index)
    {
        $this->container = new ColumnContainer($row->columns,$this);
        $this->grid = $grid;
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;

    }

    public function inspectColumns()
    {
        /**
         *  @var $column Column
         */

        foreach($this->container->columns as $column){
            $column->inspectItem();
        }

    }

    public function getHtmlContent()
    {
      return Grid::renderBlock('row',[
          'container' => $this->container
      ],$this->grid->template);
    }
    /**
     * @return Grid
     */
    public function parent()
    {
        return $this->grid;
    }
}