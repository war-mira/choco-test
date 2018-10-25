<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.2018
 * Time: 11:48
 */

namespace App\Observers;


use App\Medcenter;
use App\Traits\Observers\Slug;

class MedcenterObserver
{
    use Slug;

    public function created(Medcenter $medcenter)
    {
        $this->makeSlug($medcenter);
    }

    public function saving(Medcenter $medcenter)
    {
        //$this->makeSlug($medcenter);
    }

}