<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Banners
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $image_file
 * @property string|null $href
 * @property string $date_to
 * @property int|null $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImageFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereUpdatedAt($value)
 * @property string|null $image_file_desktop
 * @property string|null $image_file_mobile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BannerClick[] $clicks
 * @property-read mixed $link
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImageFileDesktop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Banner whereImageFileMobile($value)
 */
class Banner extends Model
{
    const POSITION = [
        0 => 'Главная А',
        1 => 'Главная Б',
        2 => 'Врач',
        3 => 'Медцентр'
    ];

    const POSITION_MAIN_A = [
        'id' => 0,
        'name' => 'Главная А'
    ];
    const POSITION_MAIN_B = [
        'id' => 1,
        'name' => 'Главная Б'
    ];
    const POSITION_EXT_A = [ //Профиль врача. поиск врача
        'id' => 2,
        'name' => 'Врач'
    ];
    const POSITION_EXT_B = [ //Профиль медцентра. поиск медцентра
        'id' => 3,
        'name' => 'Медцентр'
    ];

    protected $table = 'banners';

    protected $fillable = [
        'id',
        'image_file_desktop',
        'image_file_mobile',
        'href',
        'date_to',
        'position',
    ];

    public function clicks()
    {
        return $this->hasMany(BannerClick::class, 'banner_id', 'id');
    }

    public function getLinkAttribute()
    {
        if (strlen(trim($this->href)) == 0 || $this->href[0] == '#')
            return "#null";
        else
            return route('banner.link', ['id' => $this->id]);
    }

    public static function atPosition($position, $expired = true)
    {
        $query = Banner::where('position', '=', $position);
        if(!$expired)
            $query = $query->whereDate('date_to', '>',Carbon::today()->toDateString());
        $banners = $query->get();
        return $banners;
    }
}
