<?php

namespace App\Models\Doctors\Traits\Relationship;

use App\Medcenter;
use App\MedicalServiceOffer;
use App\Models\Doctors\Doctor;
use App\Models\Doctors\DoctorJobSchedule;
use App\Models\Doctors\DoctorJobScheduleRecord;

/**
 * Trait DoctorJobRelationship
 * @package App\Models\Doctors\Traits\Relationship
 */
trait DoctorJobRelationship
{
    /**
     * @return mixed
     */
    public function schedules()
    {
        return $this->hasMany(DoctorJobSchedule::class);
    }

    /**
     * @return mixed
     */
    public function scheduleRecords()
    {
        return $this->hasManyThrough(DoctorJobScheduleRecord::class, DoctorJobSchedule::class);
    }

    /**
     * @return mixed
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * @return mixed
     */
    public function medCenter()
    {
        return $this->belongsTo(Medcenter::class, 'medcenter_id');
    }

    /**
     * @return mixed
     */
    public function offers()
    {
        return $this->morphMany(MedicalServiceOffer::class, 'provider');
    }
}
