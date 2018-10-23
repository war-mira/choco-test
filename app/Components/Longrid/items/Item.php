<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;




use App\Components\Longrid\Grid;

class Item
{

    public function getHtmlBlock($template,$data = [])
    {
        return Grid::renderBlock('item',$data,$template);
    }
    public static function getItemHtml($template,$data = [])
    {
        return Grid::renderBlock('item',$data,$template);
    }
}