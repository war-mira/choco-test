<?php

namespace App\Models\Doctors\Traits\Method;

/**
 * Trait DoctorJobScheduleMethod
 * @package App\Models\Doctors\Traits\Method
 */
trait DoctorJobScheduleMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return ((int) $this->status === 1);
    }
}
