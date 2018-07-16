<?php

namespace App;

use App\Helpers\FormatHelper;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int                                                                                                            $id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $email
 * @property string                                                                                                         $password
 * @property string|null                                                                                                    $remember_token
 * @property \Carbon\Carbon|null                                                                                            $created_at
 * @property \Carbon\Carbon|null                                                                                            $updated_at
 * @property string                                                                                                         $phone
 * @property int $city город пользователя
 * @property int                                                                                                            $superuser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSuperuser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @property int $city_id город пользователя
 * @property int                                                                                                            $role
 * @property string|null                                                                                                    $avatar
 * @property \Carbon\Carbon|null                                                                                            $birthday
 * @property int                                                                                                            $email_confirmed
 * @property string|null                                                                                                    $email_confirm_token
 * @property int                                                                                                            $phone_verified
 * @property-read mixed                                                                                                     $birthday_f
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[]                                                     $operatorOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CommentRate[]                                               $rates
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailConfirmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 */
class User extends Authenticatable implements CanResetPassword
{
    use Notifiable, \Illuminate\Auth\Passwords\CanResetPassword;

    const ROLE_MEDCENTER = 10;
    const ROLE_DOCTOR = 20;


    const OPERATORS = [
        33,//Кесиди
        396,//Жулдыз
        2322,//Виктория Казбековна
        10131,//Айгерим Халелова
        11024,//Альбина Тилепберди
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'city_id',
        'avatar',
        'birthday',
        'role'
    ];
    protected $dates = [
        'birthday'
    ];

    protected $appends = [
        'birthday_f'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getOperators()
    {
        return User::find(self::OPERATORS);
    }

    public function getBirthdayFAttribute()
    {
        return isset($this->birthday) ? $this->birthday->format('Y-m-d') : null;
    }

    public function setPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['phone'] = null;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function operatorOrders()
    {
        return $this->hasMany(Order::class, 'operator_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany(CommentRate::class, 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $email = $this->email;

    }

}
