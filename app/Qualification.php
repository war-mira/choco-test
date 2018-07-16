<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Question
 *
 * @property int        $user_id
 * @property string     $string
 * @property int        $status
 * @property int        $created_at
 * @property int        $updated_at
 * @package App
 */
class Qualification extends Model
{
    protected $table = 'qualifications';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctors_qualifications', 'qualification_id', 'doctor_id');
    }

}
