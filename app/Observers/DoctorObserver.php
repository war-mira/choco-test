<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.01.2018
 * Time: 11:42
 */

namespace App\Observers;


use App\Doctor;

class DoctorObserver
{
    public function updating(Doctor $doctor)
    {
        $transName = \Slug::make($doctor->name);
        $doctor->alias = $doctor->id . "-" . $transName;
    }
}