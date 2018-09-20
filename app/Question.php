<?php

namespace App;

use App\Helpers\votes;
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
class Question extends Model
{
    use votes;

    const STATUS = [
        0 => 'Модерация',
        1 => 'Допущенный',
        2 => 'Закрытый'
    ];

    const NOT_ANSWERED = 0;
    const ANSWERED = 1;
    const ANSWERED_BY_DOCTOR = 2;

    protected $table = 'questions';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'text',
        'status',
        'created_at',
        'updated_at'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->HasOne(QuestionUser::class, 'question_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'question_id', 'id');
    }

    public function exceptDoctor($doctor)
    {
        $answers = $this->answers()->where('doctor_id', '!=', $doctor->id)->get();

        return $answers;
    }

    public function scopeNotAnswered($query)
    {
        $questions = $query->doesntHave('answers');

        return $questions;
    }

    public function scopeAnsweredNotByDoctor($query, $doctor)
    {
        $questions = $query->whereHas('answers', function ($query) use($doctor) {
            $query->where('doctor_id', '!=', $doctor->id);
        });

        return $questions;
    }

    public function scopeAnsweredByDoctor($query, $doctor)
    {
        $questions = $query
            ->whereHas('answers', function ($query) use($doctor) {
                $query->where('doctor_id', $doctor->id);
            })  ;

        return $questions;
    }
}
