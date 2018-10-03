<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.12.2017
 * Time: 14:52
 */

class BaseMenu
{
    protected $text = '-';
    protected $keyboard = [];

    public function __construct($data)
    {
        $this->text = $data->text;
        $this->keyboard = $data->keyboard;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getKeyboard()
    {
        return $this->keyboard;
    }
}