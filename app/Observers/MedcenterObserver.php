<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.2018
 * Time: 11:48
 */

namespace App\Observers;


use App\Medcenter;

class MedcenterObserver
{
    public function updating(Medcenter $medcenter)
    {
        $transName = \Slug::make($medcenter->name);
        $medcenter->alias = $medcenter->id . "-" . $transName;
    }
}