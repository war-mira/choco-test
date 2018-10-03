<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BannerClick
 *
 * @property int $id
 * @property \Carbon\Carbon $clicked_at
 * @property string $fingerprint
 * @property int $banner_id
 * @property-read \App\Banner $banner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BannerClick whereBannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BannerClick whereClickedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BannerClick whereFingerprint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BannerClick whereId($value)
 * @mixin \Eloquent
 */
class BannerClick extends Model
{
    protected $table = 'banner_clicks';
    public $timestamps = false;

    protected $fillable = [
        'fingerprint',
        'clicked_at',
        'banner_id'
    ];
    protected $dates = ['clicked_at'];

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }
}
