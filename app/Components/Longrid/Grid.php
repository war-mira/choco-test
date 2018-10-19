<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:33
 */

namespace App\Components\Longrid;


/**
 * Class Grid
 * @package app\components\longrid
 *
 *
 * Убрать доступ к родителям
 */
class Grid
{
    /**
     * @var array

     */
    public $rows = [];
    public $template;
    //For AMP
    public $used_tags = [];
    public function __construct($rows,$template = 'default')
    {

        foreach ($rows as $index=>$row){
            array_push($this->rows,new Row($row,$this,$index));
        }
        $this->template = $template;
    }

    public function prepare()
    {
        $text = '';
        $this->inspectRows();
        foreach($this->rows as $row){
            $text .= $row->getHtmlContent();
        }

        return $text;
    }

    public function inspectRows()
    {
        foreach($this->rows as $row){
            /**
             *  @var $row Row
             */
            $row->inspectColumns();
        }

    }
    public function getGrid()
    {
        return $this;
    }

    public function getUsedTags()
    {
        return $this->used_tags;
    }

    public function setUsedTag($tag)
    {
        if(!in_array($tag,$this->getUsedTags())){
            array_push($this->used_tags,$tag);
        }
    }
    public static function renderBlock($type,$data,$template = 'default')
    {
        return view('longrid.'.$template.'.blocks._'.$type,$data);
    }

}