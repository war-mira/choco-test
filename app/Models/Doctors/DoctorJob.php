<?php

namespace App\Models\Doctors;

use App\Models\Doctors\Traits\Method\DoctorJobMethod;
use App\Models\Doctors\Traits\Relationship\DoctorJobRelationship;
use App\Models\Doctors\Traits\Scope\DoctorJobScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorJob
 * @package App\Models\Doctors
 */
class DoctorJob extends Model
{
    use DoctorJobRelationship, DoctorJobScope, DoctorJobMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['medcenter_id', 'min_price', 'color'];
}
