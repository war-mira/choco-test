<?php

namespace App\Model;

use App\Helpers\FormatHelper;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Feedback
 *
 * @property int                 $id
 * @property string              $phone
 * @property string              $name
 * @property string              $email
 * @property int|null            $user_id
 * @property string              $text
 * @property int                 $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Feedback whereUserId($value)
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    protected $table = 'feedbacks';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'text',
        'status'
    ];

    protected $attributes = [
        'status' => 0
    ];

    public function setPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['phone'] = null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
