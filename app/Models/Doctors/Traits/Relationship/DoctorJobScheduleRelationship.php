<?php

namespace App\Models\Doctors\Traits\Relationship;

use App\Models\Doctors\DoctorJob;
use App\Models\Doctors\DoctorJobScheduleRecord;

/**
 * Trait DoctorJobScheduleRelationship
 * @package App\Models\Doctors\Traits\Relationship
 */
trait DoctorJobScheduleRelationship
{
    /**
     * @return mixed
     */
    public function doctorJob()
    {
        return $this->belongsTo(DoctorJob::class);
    }

    /**
     * @return mixed
     */
    public function records()
    {
        return $this->hasMany(DoctorJobScheduleRecord::class);
    }
}
