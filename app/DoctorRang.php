<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    const RANG_COMPUTED = [
        'RANG_KEY_STATIC_COMMENTS',
        'RANG_KEY_STATIC_FILLING_PERCENT',
        'RANG_KEY_DYNAMIC_COMMENTS',
        'RANG_KEY_DYNAMIC_ANSWERS',
    ];

    const RANG_KEY_TOTAL =
    [
      'id' => 0,
      'name' => 'total',
      'weight'=> 1
    ];

    const RANG_KEY_STATIC_COMMENTS =
    [
        'id' => 1,
        'name' => 'key_static_comments',
        'weight'=> 0.25
    ];

    const RANG_KEY_STATIC_FILLING_PERCENT =
    [
        'id' => 2,
        'name' => 'key_static_filling_percent',
        'weight'=> 0.25
    ];

    const RANG_KEY_DYNAMIC_COMMENTS =
    [
        'id' => 3,
        'name' => 'key_dynamic_comments',
        'weight'=> 0.25
    ];

    const RANG_KEY_DYNAMIC_ANSWERS =
    [
        'id' => 4,
        'name' => 'key_dynamic_questions_answers',
        'weight'=> 0.25
    ];

    public static function key_static_comments_setter(Doctor $doctor)
    {
        return $doctor->publicComments()->count()>=5?1:0;
    }

    public static function key_static_filling_percent_setter(Doctor $doctor)
    {
        return $doctor->fillingPercentage['percent']/100;
    }

    public static function key_dynamic_comments_setter(Doctor $doctor)
    {
        $comments = $doctor
//            ->comments()
            ->publicComments()
            ->where('created_at','>=',Carbon::now()->subMonths(3))
            ->get();

        $sumRate = $comments->sum('user_rate');
        $countRate = $comments->count();
        $avgRate = $countRate <= 0 ? 0 : $sumRate / $countRate;

        return $avgRate/10;
    }
    public static function key_dynamic_questions_answers_setter(Doctor $doctor)
    {
        return
            $doctor->question_answers()
                ->where('created_at','>=',Carbon::now()->subMonths(3))
                ->count()
            / Question::where('created_at','>=',Carbon::now()->subMonths(3))
                ->count();
    }




}
