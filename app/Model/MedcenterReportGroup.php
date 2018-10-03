<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\MedcenterReportGroup
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $from
 * @property \Carbon\Carbon $to
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\MedcenterReport[] $reports
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\MedcenterReportGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedcenterReportGroup extends Model
{
    protected $table = 'medcenter_report_groups';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'from',
        'to',
        'status'
    ];

    protected $dates = [
        'from',
        'to'
    ];
    protected $attributes = [
        'status' => 0
    ];

    public function reports()
    {
        return $this->hasMany(MedcenterReport::class, 'report_group_id', 'id');
    }
}
