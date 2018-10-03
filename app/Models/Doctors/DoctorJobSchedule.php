<?php

namespace App\Models\Doctors;

use App\Models\Doctors\Traits\Method\DoctorJobScheduleMethod;
use App\Models\Doctors\Traits\Relationship\DoctorJobScheduleRelationship;
use App\Models\Doctors\Traits\Scope\DoctorJobScheduleScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorJobSchedule
 * @package App\Models\Doctors
 */
class DoctorJobSchedule extends Model
{
    use DoctorJobScheduleRelationship, DoctorJobScheduleScope, DoctorJobScheduleMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'status'];
}
