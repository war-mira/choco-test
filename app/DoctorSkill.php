<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DoctorSkill
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $doctor_id
 * @property int|null $skill_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorSkill whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorSkill whereSkillId($value)
 */
class DoctorSkill extends Model
{
    protected $table = 'doctors_skills';
    protected $fillable = [
        'doctor_id',
        'skill_id',
        'position'
    ];

}
