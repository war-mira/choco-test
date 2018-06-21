<?php

namespace App;

use App\Enums\Order\NotifyType;
use App\Enums\OrderStatus;
use App\Enums\SmsNotification\ConfirmStatus;
use App\Enums\SmsNotification\SendStatus;
use App\Helpers\FormatHelper;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Orders
 *
 * @property-read \App\Doctor                                                     $doctor
 * @property-read \App\Medcenter                                                  $medcenter
 * @mixin \Eloquent
 * @property int                                                                  $id
 * @property int|null                                                             $doc_id Врач
 * @property int|null                                                             $promo_id Акция
 * @property int|null                                                             $med_id Мед. центр
 * @property string|null                                                          $client ФИО клиента
 * @property string|null                                                          $phone Телефон
 * @property string|null                                                          $email email
 * @property string|null                                                          $problem Проблема
 * @property string|null                                                          $action Действие
 * @property int|null                                                             $send_notify Отправлять уведомления
 * @property int|null                                                             $date_event Дата приема
 * @property int|null                                                             $date_event2
 * @property int|null                                                             $date_update Дата изменения
 * @property int|null                                                             $date_create Дата создания
 * @property string|null                                                          $user_ip
 * @property int|null                                                             $user_id
 * @property int|null                                                             $status Статус
 * @property int                                                                  $pay_status Оплачен ли заказ
 * @property int                                                                  $pay_status_for_idoctor Оплачен ли в IDoc
 * @property string|null                                                          $payment Тип оплаты
 * @property int|null                                                             $price
 * @property string|null                                                          $time
 * @property int|null                                                             $skill_id
 * @property string|null                                                          $operator Оператор
 * @property int                                                                  $from_internet Заявка из интернета: 1-да
 * @property string|null                                                          $pay_text информация об оплате из paybox
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDateEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDateEvent2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDateUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDocId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereFromInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereMedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePayStatusForIdoctor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePayText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePromoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSendNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserIp($value)
 * @property string|null                                                          $client_name ФИО клиента
 * @property string|null                                                          $operator_name Оператор
 * @property int|null                                                             $client_id
 * @property int|null                                                             $city_id
 * @property int|null                                                             $operator_id
 * @property int                                                                  $notify_before
 * @property \Carbon\Carbon|null                                                  $created_at
 * @property \Carbon\Carbon|null                                                  $updated_at
 * @property \Carbon\Carbon|null                                                  $event_date
 * @property \Carbon\Carbon|null                                                  $event2_date
 * @property int|null                                                             $callback_id
 * @property-read \App\Callback|null                                              $callback
 * @property-read mixed                                                           $client_info
 * @property mixed                                                                $notify_before_minutes
 * @property-read mixed                                                           $operator_info
 * @property-read mixed                                                           $status_tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SmsNotification[] $smsNotifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCallbackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereEvent2Date($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereNotifyBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOperatorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 */
class Order extends Model
{
    const STATUS = [
        [
            'id'   => 0,
            'name' => 'Новый'
        ],
        [
            'id'   => 1,
            'name' => 'Проверить посещение'
        ],
        [
            'id'   => 2,
            'name' => 'Посетил'
        ],
        [
            'id'   => 3,
            'name' => 'Не посетил'
        ],
        [
            'id'   => 12,
            'name' => 'Нет ответа'
        ],
        [
            'id'   => 15,
            'name' => 'В работе'
        ],
        [
            'id'   => 6,
            'name' => 'Записать на прием'
        ],
        [
            'id'       => 7,
            'name'     => 'Отказ',
            'children' =>
                [
                    [
                        'id'   => 17,
                        'name' => 'Записался сам',
                    ],
                    [
                        'id'   => 9,
                        'name' => 'Не устроила цена',
                    ],
                    [
                        'id'   => 18,
                        'name' => 'Не подходит по местоположению'
                    ]
                ]
        ],
        [
            'id'       => 14,
            'name'     => 'Другое',
            'children' =>
                [
                    [
                        'id'   => 13,
                        'name' => 'Повтор',
                    ],
                    [
                        'id'   => 19,
                        'name' => 'Ошибка номера',
                    ],
                    [
                        'id'   => 20,
                        'name' => 'Перевод на другого оператора'
                    ],
                    [
                        'id'   => 21,
                        'name' => 'Перевод на клинику'
                    ],
                    [
                        'id'   => 23,
                        'name' => 'Другой город'
                    ],
                    [
                        'id'   => 24,
                        'name' => 'Уточнение информации'
                    ],
                    [
                        'id'   => 8,
                        'name' => 'Нет врача'
                    ],
                    [
                        'id'   => 10,
                        'name' => 'Плохая локация'
                    ],
                    [
                        'id'   => 11,
                        'name' => 'Тест'
                    ],
                ]
        ],
    ];

    const PAY_STATUS = [
        0 => 'Не оплачен',
        1 => 'Оплачен'
    ];

    const NOTIFY_STATUS = [
        0 => 'Не оплачен',
        1 => 'Оплачен'
    ];
    public $timestamps = true;
    protected $table = 'orders';
    protected $fillable =
        [
            'doc_id',
            'date_event',
            'date_event2',
            'event2_date',
            'event_date',
            'date_update',
            'date_create',
            'ga_complete',
            'med_id',
            'time',
            'city_id',
            'client_id',
            'client_name',
            'operator_name',
            'operator_id',
            'pay_text',
            'payment',
            'action',
            'problem',
            'email',
            'phone',
            'status',
            'send_notify',
            'pay_status_for_idoctor',
            'pay_status',
            'from_internet',
            'notify_before',
            'callback_id'
        ];
    protected $appends = ['client_info', 'operator_info', 'status_tag', 'status_description'];
    protected $with = ['doctor', 'medcenter'];
    protected $dates = ['event_date', 'event2_date'];


    public function setPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['phone'] = null;
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function callback()
    {
        return $this->belongsTo(Callback::class, 'callback_id', 'id');
    }

    public function medcenter()
    {
        return $this->belongsTo(Medcenter::class, 'med_id', 'id');
    }

    public function getNotifyBeforeMinutesAttribute()
    {
        return ($this->notify_before / 60);
    }

    public function setNotifyBeforeMinutesAttribute($value)
    {
        $this->notify_before = $value * 60;
    }

    public function getPreNotificationDateAttribute()
    {
        return isset($this->event_date) ? $this->event_date->subSeconds($this->notify_before) : null;
    }

    public function getOperatorInfoAttribute($value)
    {
        $operator = [];
        if (isset($this->attributes['operator_id'])) {
            $operator = $this->operator;
        } else if (isset($this->attributes['operator_name'])) {
            if (is_numeric($this->attributes['operator_name'])) {
                $operator = User::find($this->operator_name);
                $this->operator()->associate($operator);
            } else {
                foreach (User::getOperators() as $_operator) {
                    if ($_operator->name == $this->attributes['operator_name']) {
                        $this->operator()->associate($_operator);
                        $operator = $_operator;
                        break;
                    }
                }
            }
        } else {
            $operator = [];
        }
        return $operator;
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }

    public function getClientInfoAttribute()
    {
        if ($this->client_id == null) {
            $client = [
                'id'      => null,
                'name'    => $this->client_name,
                'phone'   => $this->phone,
                'email'   => $this->email,
                'city_id' => $this->city_id
            ];
        } else {
            $client = $this->client;
        }
        return $client;
    }

    public function getStatusDescriptionAttribute()
    {
        return OrderStatus::getDescription($this->status);
    }

    public function getStatusTagAttribute()
    {
        $tag = '';
        switch ($this->status) {
            case 2:
                $tag = '+';
                break;
            case 3:
                $tag = '?';
                break;
        }
        return $tag;
    }

    public function generateFeedbackToken()
    {
        $token = str_random(16);
        $this->feedback_token = $token;
        $this->save();
    }

    public function changedStatusTo($status)
    {
        return $this->isDirty('status') && $this->status == $status;
    }

    public function sendSms()
    {
        return $this->send_notify == NotifyType::SMS ||
            $this->send_notify == NotifyType::SMS_EMAIL;
    }

    public function changedNotificationAttributes()
    {
        return $this->isDirty('med_id')
            || $this->isDirty('doc_id')
            || $this->isDirty('event_date');
    }

    public function pendingNotifications()
    {
        return $this->smsNotifications()
            ->where('send_status', SendStatus::NONE)
            ->where('confirm_status', ConfirmStatus::CONFIRM);
    }

    public function smsNotifications()
    {
        return $this->hasMany(SmsNotification::class, 'order_id', 'id');
    }

    public function gaEvents()
    {
        return $this->morphMany(GaEvent::class, 'source');
    }

}
