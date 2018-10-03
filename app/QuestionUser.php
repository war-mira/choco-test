<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class QuestionUser
 *
 * @property int        $question_id
 * @property int        $doctor_id
 * @property string     $firstname
 * @property string     $lastname
 * @property string     $email
 * @property string     $gender
 * @property string     $birthday
 * @property string     $city
 * @property int        $created_at
 * @property int        $updated_at
 * @package App
 */
class QuestionUser extends Model
{
    const GENDERS = [
        '0' => 'Мужской',
        '1' => 'Женский'
        ];

    protected $table = 'question_users';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'question_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'birthday',
        'city',
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id', 'question_id');
    }

}
