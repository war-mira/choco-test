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
class Question extends Model
{
    const STATUS = [
        0 => 'Модерация',
        1 => 'Допущенный',
        2 => 'Закрытый'
    ];

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

}
