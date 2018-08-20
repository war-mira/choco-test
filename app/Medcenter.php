<?php

namespace App;

use App\Helpers\SeoMetadataHelper;
use App\Helpers\SessionContext;
use App\Interfaces\IReferenceable;
use App\Interfaces\ISeoMetadata;
use App\Model\Location\District;
use App\Model\ServiceItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ixudra\Curl\Facades\Curl;

/**
 * App\Medcenters
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Doctor[]  $doctors
 * @mixin \Eloquent
 * @property int                                                          $id
 * @property string                                                       $name Имя
 * @property string                                                       $alias Фамилия
 * @property int                                                          $ambulatory Выезд на дом
 * @property int                                                          $price Цена
 * @property int                                                          $rate Рейтинг
 * @property int                                                          $city_id Опыт работы
 * @property string                                                       $map Карта
 * @property string                                                       $content Описание
 * @property string                                                       $content_lite Краткое описание
 * @property string|null                                                  $geo_lat
 * @property string|null                                                  $geo_lon
 * @property string|null                                                  $meta_key Ключевые слова
 * @property string|null                                                  $meta_desc Краткое описание
 * @property int                                                          $date_create Дата публикации
 * @property int                                                          $date_update Дата изменения
 * @property int|null                                                     $user_id
 * @property int                                                          $status Опубликован?
 * @property int                                                          $money_balans
 * @property int                                                          $commission Комиссия Idoc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereAmbulatory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereContentLite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereDateCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereDateUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereGeoLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereGeoLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereMoneyBalans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereUserId($value)
 * @property string|null                                                  $avatar
 * @property string|null                                                  $email
 * @property-read \App\City                                               $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read mixed                                                   $href
 * @property-read mixed                                                   $name_with_status
 * @property-read mixed                                                   $status_name
 * @property-read mixed                                                   $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[]   $orders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter localPublic()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Medcenter whereEmail($value)
 */
class Medcenter extends Model implements IReferenceable, ISeoMetadata
{
    const STATUS = [
        -1 => 'Заблокирован',
        0  => 'Скрыт',
        1  => 'Опубликован',
        2  => 'Модерация',
        3  => 'Статичный',
        4  => 'Системный'
    ];
    const PARTNER = 1;
    const NOT_PARTNER = 0;
    public $timestamps = false;
    protected $table = 'medcenters';
    protected $fillable = [
        'name',
        'alias',
        'ambulatory',
        'rate',
        'money_balans',
        'price',
        'map',
        'city_id',
        'content',
        'content_lite',
        'district_id',
        'meta_title',
        'meta_key',
        'meta_desc',
        'meta_h1',
        'sms_address',
        'status',
        'commission',
        'geo_lat',
        'geo_lon',
        'avatar',
        'email',
        'seo_text',
        'partner',
        'mond',
        'tues',
        'wedn',
        'thur',
        'frid',
        'satu',
        'sund'
    ];

    protected $attributes = [
        'content'    => ' ',
        'meta_h1'    => ' ',
        'meta_title' => ' '
    ];

    public function scopeLocalPublic($query)
    {
        return $query->where('medcenters.status', 1)->where('city_id', SessionContext::city()->id);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(\App\Models\District::class, '	district_id', 'id');
    }

    public function getAvatarAttribute()
    {
        return $this->attributes['avatar'] ?? asset('images/no-userpic.gif');
    }

    public function skills()
    {
        $skills = $this->publicDoctors()->with('skills')->get()->pluck('skills')->flatten()->unique('id')->sortBy('name');
        return $skills;
    }

    public function publicDoctors()
    {
        return $this->doctors()->where('doctors.status', 1);
    }

    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, DoctorJob::class, 'medcenter_id', // Foreign key on users table...
            'id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'doctor_id');
    }

    public function getHrefAttribute()
    {
        return route('medcenter.item', ['medcenter' => $this->alias]);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function publicComments()
    {
        return $this->comments()->where('comments.status', 1);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'owner');
    }

    public function getTypeAttribute()
    {
        return 'медцентр';
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getNameWithStatusAttribute()
    {
        return $this->name . " (" . $this->status_name . ")";
    }

    public function getCoordinatesAttribute()
    {
        $latitude = $this->geo_lat;
        $longitude = $this->geo_lon;

//        if(isset($latitude) && $latitude!= 0 && isset($longitude) && $longitude!=0){
//            return  $latitude.','.$longitude;
//        }
            $city = City::find($this->city_id);
            $address = $city->name.' '.$this->sms_address;

        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?format=json&geocode='.$address.'');
        $response = $response->getBody();
        $response = $response->getContents();
        $response = json_decode($response, true);
        $firstObject = array_shift($response['response']['GeoObjectCollection']['featureMember']);
        $points = $firstObject['GeoObject']['Point']['pos'];
        $points = str_replace(' ', ', ', $points);
        $points = implode(', ', array_reverse(explode(', ', $points)));;

        return $points;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'med_id', 'id');
    }

    public function updateCommentRate()
    {
        $rate = round($this->allComments()->where('status', 1)->avg('user_rate'));
        $this->rate = $rate / 2;
        $this->save();
    }

    public function allComments()
    {
        $docIds = $this->doctors()->pluck('doctors.id');
        $medId = $this->id;

        $allComments = Comment::query()->where(function (Builder $query) use ($docIds, $medId) {

            $query->where(function (Builder $query) use ($docIds) {
                $query->where('owner_type', 'Doctor');
                $query->whereIn('owner_id', $docIds);
            });
            $query->orWhere(function (Builder $query) use ($medId) {
                $query->where('owner_type', 'Medcenter');
                $query->where('owner_id', $medId);
            });
        })->where('status', 1);

        return $allComments;
    }

    public function scopeCity(Builder $query, $city = null)
    {
        $city = $city ?? SessionContext::city();
        return $query->where('city_id', $city->id);
    }

    public function scopePublic(Builder $query, $status = 1)
    {

        return $query->where('status', $status);
    }

    public function scopeHavingDoctorsInCity(Builder $query, $city)
    {
        return $query->with('doctors')->withCount(['doctors' => function ($query) use ($city) {
            $query->where('doctors.status', 1)
                ->where('city_id', $city->id);
        }])->whereHas('doctors', function ($query) use ($city) {
            $query->where('doctors.status', 1)
                ->where('city_id', $city->id);
        });
    }


    public function getMetaTitle()
    {
        return empty($this->meta_title) ? ($this->name . ' - Сервис по поиску врачей iDoctor.kz') : $this->meta_title;
    }

    public function getMetaDescription()
    {
        $desc = "Многопрофильное медицинское учреждение - " . str_replace("Медицинский центр ", "", $this->name) . ". ". SeoMetadataHelper::DEFAULT_DESCRIPTION;
        if(!empty($this->meta_desc)){
            $desc = $this->meta_desc;
        }
        return $desc;
    }

    public function getMetaKeywords()
    {
        return empty($this->meta_key) ? $this->name : $this->meta_key;
    }

    public function getMetaHeader()
    {
        return empty($this->meta_h1) ? $this->name : $this->meta_h1;
    }

    public function getSeoText()
    {
        return empty($this->seo_text) ? '' : $this->seo_text;
    }
}
