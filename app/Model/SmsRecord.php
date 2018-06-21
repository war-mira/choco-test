<?php

namespace App\Model;

use App\Helpers\FormatHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SmsRecord
 *
 * @property int                 $id
 * @property string|null         $service
 * @property string              $login
 * @property string              $recipient
 * @property int                 $status
 * @property string              $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed          $status_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SmsRecord whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SmsRecord extends Model
{
    const STATUS = [
        -1 => 'Ошибка',
        0  => 'Ожидание',
        1  => 'Отправлено',
        2  => 'Доставлено',
        3  => 'Неизвестно'
    ];

    protected $table = 'sms_records';
    public $timestamps = true;

    protected $fillable = [
        'service',
        'login',
        'status',
        'recipient',
        'text'
    ];

    public function setRecipientAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['recipient'] = FormatHelper::phone($phone);
        else
            $this->attributes['recipient'] = null;
    }


    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status] ?? '-';
    }
}
