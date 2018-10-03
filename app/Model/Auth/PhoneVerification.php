<?php

namespace App\Model\Auth;

use App\Helpers\FormatHelper;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Auth\PhoneVerification
 *
 * @property int                 $id
 * @property int                 $user_id
 * @property string              $phone
 * @property int                 $status
 * @property string              $request_timestamp
 * @property string              $expire_timstamp
 * @property string              $verify_hash
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User      $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereExpireTimstamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereRequestTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Auth\PhoneVerification whereVerifyHash($value)
 * @mixin \Eloquent
 */
class PhoneVerification extends Model
{
    protected $table = 'phone_verifications';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'phone',
        'status',
        'request_timestamp',
        'expire_timestamp',
        'verify_code'
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
