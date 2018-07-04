<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionAnswer
 *
 * @property int        $question_id
 * @property int        $doctor_id
 * @property string     $text
 * @property int        $created_at
 * @property int        $updated_at
 * @package App*
 */
class QuestionAnswer extends Model
{
    protected $table = 'question_answers';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'question_id',
        'doctor_id',
        'text',
        'created_at',
        'updated_at'
    ];

   public function question()
   {
       return $this->belongsTo(Question::class, 'id', 'question_id');
   }

   public function doctor()
   {
       return $this->belongsTo(Doctor::class, 'id', 'doctor_id');
   }

}
