<?php

namespace App\Models\Doctors\Traits\Method;

/**
 * Trait DoctorJobMethod
 * @package App\Models\Doctors\Traits\Method
 */
trait DoctorJobMethod
{
    /**
     * @return mixed
     */
    public function getActiveSchedule()
    {
        return $this->schedules()->where('status', 1)->first();
    }
}
