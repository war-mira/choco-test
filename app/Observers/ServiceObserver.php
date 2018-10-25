<?php
/**
 * Created by PhpStorm.
 * User: Mamyraimov Asset
 * Date: 24.01.2018
 * Time: 11:42
 */

namespace App\Observers;


use App\Doctor;
use App\Service;
use App\ServiceGroup;
use App\Skill;
use App\Traits\Observers\Slug;

class ServiceObserver
{
    use Slug;

    public function created(Service $service)
    {
        $this->makeSlug($service);
    }

}