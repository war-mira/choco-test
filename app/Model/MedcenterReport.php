<?php

namespace App\Model;

use App\Medcenter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MedcenterReport
 *
 * @property int $id
 * @property int $medcenter_id
 * @property int $report_group_id
 * @property \Carbon\Carbon $from
 * @property \Carbon\Carbon $to
 * @property int $status
 * @property string|null $download_url
 * @property string|null $email
 * @property string|null $email2
 * @property int|null $total
 * @property \Carbon\Carbon|null $formed_at
 * @property \Carbon\Carbon|null $sent_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $status_name
 * @property-read \App\Model\MedcenterReportGroup $group
 * @property-read \App\Medcenter $medcenter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereDownloadUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereEmail2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereFormedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereMedcenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereReportGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedcenterReport extends Model
{
    const STATUS = [
        0 => 'Новый',
        1 => 'Сформирован',
        2 => 'Отправлен'
    ];

    protected $table = 'medcenter_reports';
    public $timestamps = true;

    protected $fillable = [
        'medcenter_id',
        'report_group_id',
        'from',
        'to',
        'formed_at',
        'status',
        'email',
        'email2',
        'download_url',
        'total'
    ];

    protected $dates = [
        'formed_at',
        'sent_at',
        'from',
        'to'
    ];
    protected $attributes = [
        'status' => 0
    ];

    public function group()
    {
        return $this->belongsTo(MedcenterReportGroup::class, 'report_group_id', 'id');
    }

    public function medcenter()
    {
        return $this->belongsTo(Medcenter::class, 'medcenter_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }
}
