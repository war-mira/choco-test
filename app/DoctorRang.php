<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DoctorJob
 *
 * @property int $id
 * @property int $doctor_id
 * @property string $key
 * @property float $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Doctor $doctor
 * @mixin \Eloquent
 */
class DoctorRang extends Model
{
    protected $table = 'doctors_rang';
    protected $fillable = [
        'doctor_id',
        'key',
        'value'
    ];

    const RANG_KEY_TOTAL =
    [
      'id' => 0,
      'name' => 'total'
    ];

    const RANG_KEY_STATIC_COMMENTS =
    [
      'id' => 1,
      'name' => 'key_static_comments'
    ];

    const RANG_KEY_STATIC_FILLING_PERCENT =
    [
      'id' => 2,
      'name' => 'key_static_filling_percent'
    ];

    const RANG_KEY_DYNAMIC_COMMENTS =
    [
      'id' => 3,
      'name' => 'key_dynamic_comments'
    ];

    const RANG_KEY_DYNAMIC_ANSWERS =
    [
      'id' => 4,
      'name' => 'key_dynamic_questions_answers'
    ];


}
