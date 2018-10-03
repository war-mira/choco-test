<?php

namespace App;

use App\Enums\SmsNotification\ConfirmStatus;
use App\Enums\SmsNotification\NotificationType;
use App\Enums\SmsNotification\SendStatus;
use App\Helpers\FormatHelper;
use App\Interfaces\SmsSendable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SmsNotification
 *
 * @property int                  $id
 * @property string               $recipient
 * @property string               $text
 * @property int|null             $order_id
 * @property int                  $type
 * @property int                  $status
 * @property string|null          $delivered_at
 * @property \Carbon\Carbon|null  $created_at
 * @property \Carbon\Carbon|null  $updated_at
 * @property-read mixed           $type_name
 * @property-read \App\Order|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification type($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereRecipient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SmsNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SmsNotification extends Model implements SmsSendable
{
    const TYPE_NEW = 0;
    const TYPE_PRE = 1;
    const TYPE_POST = 2;
    const TYPE = [
        self::TYPE_NEW  => 'После оформления',
        self::TYPE_PRE  => 'Перед приемом',
        self::TYPE_POST => 'Отзыв'
    ];


    const STATUS = [
        0  => 'Ожидание',
        -2 => 'Отклонено',
        1  => 'Подтверждено',
        2  => 'Отправлено',
        -1 => 'Ошибка'
    ];
    public $timestamps = true;
    protected $table = 'sms_notifications';
    protected $fillable = [
        'recipient',
        'text',
        'order_id',
        'type',
        'status',
        'delivered_at',
        'send_at',
        'confirm_status',
        'send_status'
    ];
    protected $appends = [
        'save_url',
        'confirm_status_description',
        'send_status_description',
        'type_description',
    ];

    protected $dates = [
        'send_at',
        'delivered_at'
    ];

    public function order()
    {

        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function setRecipientAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['recipient'] = FormatHelper::phone($phone);
        else
            $this->attributes['recipient'] = null;
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getSmsRecipient()
    {
        return $this->recipient;
    }

    public function getSmsText()
    {
        return $this->text;
    }

    public function getSaveUrlAttribute()
    {
        return route('admin.notifications.save', ['id' => $this->id]);
    }

    public function getConfirmStatusDescriptionAttribute()
    {
        return ConfirmStatus::get($this->confirm_status);
    }

    public function getSendStatusDescriptionAttribute()
    {
        return SendStatus::get($this->send_status);
    }

    public function getTypeDescriptionAttribute()
    {
        return NotificationType::get($this->type);
    }

    public function syncWithOrder()
    {
        if ($this->order) {
            \NotificationService::syncOrderNotification($this);
        }
    }

    public function shouldSend()
    {
        return $this->order->sendSms();
    }
}
