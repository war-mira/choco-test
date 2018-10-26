<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.09.2018
 * Time: 13:09
 */

namespace App\Traits\Observers;


trait Slug
{
    public function makeSlug($model)
    {
        $newName =  preg_replace('~[\\*?"<>|]~', '', $model->name);
        $transName = \Slug::make($newName);
        $model->alias = $model->id . "-" . $transName;
        $model->save();
    }
}