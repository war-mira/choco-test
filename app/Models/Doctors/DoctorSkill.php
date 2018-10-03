<?php

namespace App\Models\Doctors;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorSkill
 * @package App\Models\Doctors
 */
class DoctorSkill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['doctor_id', 'skill_id', 'position'];
}
