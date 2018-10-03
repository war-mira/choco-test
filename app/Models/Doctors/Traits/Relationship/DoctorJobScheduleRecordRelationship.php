<?php

namespace App\Models\Doctors\Traits\Relationship;

use App\Models\Doctors\DoctorJobSchedule;

/**
 * Trait DoctorJobScheduleRecordRelationship
 * @package App\Models\Doctors\Traits\Relationship
 */
trait DoctorJobScheduleRecordRelationship
{
    /**
     * @return mixed
     */
    public function schedule()
    {
        return $this->belongsTo(DoctorJobSchedule::class);
    }
}
