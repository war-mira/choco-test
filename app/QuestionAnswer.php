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
       return $this->belongsTo(Question::class, 'question_id', 'id');
   }

   public function doctor()
   {
       return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
   }

   public function scopeByDoctorQuestion($query, $doctor, $question){
       $answer = $query->where('doctor_id', $doctor->id)->where('question_id', $question->id);

       return $answer;
   }

   public function exceptDoctor($query, $doctor, $question)
   {
       $answers = $query->where('question_id', $question->id)->where('doctor_id', '!=', $doctor->id)->get();

       return $answers;
   }

}
