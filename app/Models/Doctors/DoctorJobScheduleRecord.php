<?php

namespace App\Models\Doctors;

use App\Models\Doctors\Traits\Relationship\DoctorJobScheduleRecordRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorJobScheduleRecord
 * @package App\Models\Doctors
 */
class DoctorJobScheduleRecord extends Model
{
    use DoctorJobScheduleRecordRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day', 'time'];
}
