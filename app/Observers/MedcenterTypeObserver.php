<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.02.2018
 * Time: 11:48
 */

namespace App\Observers;


use App\Medcenter;
use App\MedcenterType;
use App\Traits\Observers\Slug;

class MedcenterTypeObserver
{
    use Slug;

    public function created(MedcenterType $medcenterType)
    {
        $this->makeSlug($medcenterType);
        $medcenterType->save();
    }

    public function saved(MedcenterType $medcenterType)
    {
        $this->makeSlug($medcenterType);
        $medcenterType->save();
    }

    public function updated(MedcenterType $medcenterType)
    {
        $this->makeSlug($medcenterType);
        $medcenterType->save();
    }

}