<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DoctorJob
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $medcenter_id
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Doctor $doctor
 * @property-read \App\Medcenter $medcenter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereMedcenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DoctorJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DoctorJob extends Model
{
    protected $table = 'doctor_jobs';
    protected $fillable = [
        'doctor_id',
        'medcenter_id',
        'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function medcenter()
    {
        return $this->belongsTo(Medcenter::class, 'medcenter_id', 'id');
    }

}
