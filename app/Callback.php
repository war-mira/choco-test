<?php

namespace App;

use App\Helpers\FormatHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Callbacks
 *
 * @property-read \App\Skill $skill
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $client
 * @property string|null $date_event
 * @property int $skill_id
 * @property string $phone
 * @property string|null $answer
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $status
 * @property string|null $operator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereDateEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereUpdatedAt($value)
 * @property string|null $client_name
 * @property string|null $event_date
 * @property string $client_phone
 * @property int|null $client_datetime
 * @property string|null $operator_comment
 * @property string $source
 * @property int|null $target_id
 * @property string|null $target_type
 * @property string|null $client_comment
 * @property int|null $operator_id
 * @property string|null $client_email
 * @property-read mixed $source_name
 * @property-read mixed $status_name
 * @property-read mixed $target_type_name
 * @property-read \App\Order $order
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $target
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereClientComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereClientEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereClientPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereOperatorComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Callback whereTargetType($value)
 */
class Callback extends Model
{
    const STATUS = [
        0 => 'Новая',
        1 => 'В работе',
        2 => 'Отвечена',
        3 => 'Повтор',
        4 => 'Отказ',
        5 => 'Ошибка'
    ];

    protected $table = 'callbacks';
    protected $fillable = [
        'ga_cid',
        'ga_complete',
        'client_name',
        'client_phone',
        'client_comment',
        'client_email',
        'target_id',
        'target_type',
        'event_date',
        'operator_id',
        'operator_comment',
        'status',
        'source'];
    public $timestamps = true;

    protected $appends = [
        'target_type_name',
        'source_name',
        'status_name'
    ];
    protected $dates = ['client_datetime'];

    public function order()
    {
        return $this->hasOne(Order::class, 'callback_id', 'id');
    }

    public function target()
    {
        return $this->morphTo();
    }

    public function skill()
    {
        return $this->hasOne(Skill::class, 'id', 'skill_id');
    }

    public function setClientPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['client_phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['client_phone'] = null;
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status] ?? '-';
    }

    public function getTargetTypeNameAttribute()
    {
        $type = $this->target_type;
        switch ($type) {
            case 'Doctor':
                $typeName = 'Врач';
                break;
            case 'Medcenter':
                $typeName = 'Медцентр';
                break;
            case 'Skill':
                $typeName = 'Специализация';
                break;
            default:
                $typeName = $type;
        }
        return $typeName;
    }

    public function getSourceNameAttribute()
    {
        $source = $this->source;
        switch ($source) {
            case 'quick_site':
                $sourceName = 'Быстрая запись';
                break;
            case 'doctor_page':
                $sourceName = 'Страница врача';
                break;
            case 'medcenter_page':
                $sourceName = 'Страница медцентра';
                break;
            case 'telegram_bot':
                $sourceName = 'Телеграм бот';
                break;
            default:
                $sourceName = 'Неизвестно';
        }
        return $sourceName;
    }

    public function gaEvents()
    {
        return $this->morphMany(GaEvent::class, 'source');
    }

    public function scopeLocalPublic($query)
    {
        return $query->where('status', 2);
    }
}
