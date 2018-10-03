<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.01.2018
 * Time: 11:42
 */

namespace App\Observers;


use App\Doctor;
use App\Traits\Observers\Slug;

class DoctorObserver
{
    use Slug;

    public function creating(Doctor $doctor)
    {
        $this->makeSlug($doctor);
    }

    public function saving(Doctor $doctor)
    {
        $this->makeSlug($doctor);
    }
}