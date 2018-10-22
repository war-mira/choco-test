<?php
/**
 * Created by PhpStorm.
 * User: Asset
 * Date: 18.05.2018
 * Time: 14:34
 */

namespace  App\Components\Longrid\Items;




use App\Components\Longrid\Grid;

class BaseItem
{
    /**
     * @var Column;
     */
    public $column;
    public $index;
    public $banners = [];
    public function __construct($item,$column)
    {
        foreach ($item as $prop=>$value){
            $this->{$prop} = $value;
        }
        $this->column = $column;

    }

    public function hasProp($prop)
    {
        return isset($this->{$prop});
    }

    public function getHtml()
    {
        $name = "App\Components\Longrid\Items\\".ucfirst($this->type);

        $item = new $name($this,$this->column);
        return $item->getHtmlBlock();
    }

    public function getHtmlBlock()
    {
        return Grid::renderBlock($this->getTemplateName(),[
            'item' => $this
        ],$this->getGridTemplate());
    }




    public function inspectSelf()
    {
        return true;
    }

    public function getGridTemplate()
    {
        return $this->getRow()->parent()->template;
    }
    public function getRow()
    {
        return $this->getColumnContainer()->parent();
    }
    public function getColumnContainer()
    {
        return $this->parent()->parent();
    }
    /**
     * @return Column
     */
    public function parent()
    {
        return $this->column;
    }
    public function getTemplateName()
    {
        if($this->hasProp('state')){
            return $this->type.'/'.$this->state;
        } else{
            return $this->type;
        }

    }

    public function setBanners($text)
    {
        $banners = self::parseShortcode('banner', $text);
        if(empty($banners)){
            return $text;
        }
        foreach ($banners as $id) {
            $banner = \app\modules\banners\front\components\ShowBannerWidget::widget([
                'type' => $id,
                'banners'=> Banners::getForPage(Banners::PAGE_ALL)
            ]);
            $text = str_replace('[banner:' . $id . ']', '', $text);
            array_push($this->banners,$banner);
        }
        return $text;
    }
    public  static function parseShortcode($param, $text) {
        preg_match_all("/\[".$param.":(.*?)\]/",$text,$matches);

        if(!$matches[0]) {
            return null;
        }
        else{

            return $matches[1];
        }
    }

    public function hasBanners()
    {
        return !empty($this->banners);
    }
}