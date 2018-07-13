<?php

namespace App;

use App\Helpers\FormatHelper;
use App\Helpers\MathHelper;
use App\Helpers\SeoMetadataHelper;
use App\Helpers\SessionContext;
use App\Interfaces\IReferenceable;
use App\Interfaces\ISeoMetadata;
use App\Model\ServiceItem;
use App\Traits\Eloquent\FilterScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Doctor
 *
 * @property int $id
 * @property string $firstname Имя
 * @property string $lastname Фамилия
 * @property string|null $qualification Фамилия
 * @property string $alias Фамилия
 * @property int|null $ambulatory Выезд на дом
 * @property int $ambulatory_price
 * @property int $child Детский
 * @property int $child_min_age Детский
 * @property int $price Цена
 * @property string|null $discount
 * @property string|null $address
 * @property float $rate Рейтинг
 * @property int $city_id Город
 * @property int|null $med_id Больница
 * @property int $works_since_unix Опыт работы
 * @property string $content Описание
 * @property string $content_lite Краткое описание
 * @property string|null $meta_title
 * @property string|null $meta_key Ключевые слова
 * @property string|null $meta_desc Краткое описание
 * @property int $created_at_unix Дата публикации
 * @property int $updated_at_unix Дата изменения
 * @property int $views Колличество просмотров
 * @property int $user_id
 * @property int $phone
 * @property int $orders_count
 * @property int $status Опубликован?
 * @property int $on_top
 * @property int $money_balans
 * @property int $commission Комиссия Idoc
 * @property string|null $avatar
 * @property int $created_by
 * @property int $updated_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $works_since
 * @property string|null $timetable
 * @property int|null $account_id
 * @property float $avg_rate
 * @property-read \App\City|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read mixed $content_description
 * @property-read mixed $exp_formatted
 * @property-read mixed $href
 * @property-read mixed $main_skill
 * @property-read mixed $medcenters_assoc
 * @property-read mixed $name
 * @property-read mixed $status_name
 * @property-read mixed $type
 * @property mixed $works_since_year
 * @property \Illuminate\Database\Eloquent\Collection|\App\DoctorJob[] $jobs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Skill[] $medcenters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Skill[] $skills
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor inCities($city_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor localPublic()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor public ($status = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAmbulatory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAmbulatoryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereAvgRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereChild($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereContentLite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereCreatedAtUnix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereMedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereMoneyBalans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereOnTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereTimetable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereUpdatedAtUnix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereWorksSince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Doctor whereWorksSinceUnix($value)
 * @mixin \Eloquent
 */
class Doctor extends Model implements IReferenceable, ISeoMetadata
{
    use FilterScopes;
    const STATUS = [
        -1 => 'Заблокирован',
        0  => 'Скрыт',
        1  => 'Опубликован',
        2  => 'Модерация',
        3  => 'Статичный',
        4  => 'Системный'
    ];
    public $timestamps = true;
    protected $table = 'doctors';
    protected $fillable = [
        'firstname',
        'lastname',
        'avatar',
        'qualification',
        'alias',
        'ambulatory',
        'ambulatory_price',
        'child',
        'price',
        'discount',
        'address',
        'city_id',
        'med_id',
        'user_id',
        'rate',
        'works_since',
        'works_since_year',
        'content',
        'content_lite',
        'meta_title',
        'meta_key',
        'meta_desc',
        'meta_h1',
        'status',
        'on_top',
        'commission',
        'created_at_unix',
        'created_at',
        'updated_at_unix',
        'updated_at',
        'account_id',
        'medcenters',
        'patronymic',
        'phone',
        'email',
        'child_min_age',
        'ambulatory_city_price',
        'ambulatory_country_price',
        'price_repeat',
        'about_text',
        'treatment_text',
        'exp_text',
        'grad_text',
        'community_text',
        'certs_text',
        'personal_site',
        'farm_partners',
        'want_web',
        'preview_text',
        'timetable',
        'seo_text',

    ];
    protected $casts = [
        'child'   => 'int',
        'city_id' => 'int'

    ];
    protected $attributes = [
        'meta_h1'     => '',
        'works_since' => '2000-01-01',
        'rate'        => 0
    ];
    protected $appends = [
        'name'
    ];

    public function getRateAttribute()
    {
        $rate = $this->attributes['rate'];
        $rate = $rate < 0 ? 0 : $rate;
        $rate = $rate > 10 ? 10 : $rate;
        return $rate;
    }

    public function setWorksSinceYearAttribute($value)
    {
        $this->works_since = Carbon::createFromDate($value)->format('Y') . "-01-01";
    }

    public function setJobsAttribute($value)
    {
        $medIds = $this->jobs()->pluck('medcenter_id')->toArray();
        $toDelete = array_diff($medIds, $value);
        $toCreate = collect(array_diff($value, $medIds))->map(function ($id) {
            return ['medcenter_id' => $id, 'doctor_id' => $this->id];
        })->toArray();
        $this->jobs()->whereIn('medcenter_id', $toDelete)->delete();
        $this->jobs()->createMany($toCreate);
    }

    public function jobs()
    {
        return $this->hasMany(DoctorJob::class, 'doctor_id', 'id');
    }

    public function getWorksSinceYearAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->works_since ?? '2000-01-01')->format('Y');
    }

    public function created_by()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updated_by()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function getHrefAttribute()
    {
        return route('doctor.item', ['city' => $this->city->alias, 'doctor' => $this->alias]);
    }

    public function getNameAttribute()
    {
        $name = $this->lastname . ' ' . $this->firstname;
        if (!empty($this->patronymic))
            $name .= (' ' . $this->patronymic);
        return $name;
    }

    public function getContentDescriptionAttribute()
    {
        return substr(strip_tags(str_replace('\r\n', '', $this->content)), 0, 256);
    }

    public function getAvatarAttribute()
    {
        return $this->attributes['avatar'] ?? asset('images/no-userpic.gif');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'doc_id', 'id');
    }

    public function getMainSkillAttribute()
    {
        return $this->skills()->first();
    }

    public function skills()
    {
        return $this
            ->belongsToMany(Skill::class,
                'doctors_skills',
                'doctor_id',
                'skill_id')
            ->withPivot(['weight']);
    }

    public function items()
    {
        return $this->morphMany(ServiceItem::class, 'vendor');
    }

    public function scopeInCities($query, $city_id)
    {
        return $query->where('city_id', $city_id);
    }

    public function scopePublic($query, $status = true)
    {
        return $query->where('status', $status);
    }

    public function scopeLocalPublic($query)
    {
        return $query->where('status', 1)->where('city_id', SessionContext::city()->id);
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getMedcentersAssocAttribute()
    {
        return $this->medcenters()->get()->mapWithKeys(function ($medcenter) {
            return [$medcenter->id => $medcenter->name_with_status];
        });
    }

    public function medcenters()
    {
        return $this->hasManyThrough(Medcenter::class, DoctorJob::class, 'doctor_id', // Foreign key on users table...
            'id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'medcenter_id');
    }

    public function getExpFormattedAttribute()
    {
        if ($this->works_since == null)
            return "";
        $exp = (string)(Carbon::now()->diffInYears(Carbon::createFromFormat('Y-m-d', $this->works_since)));

        $replaces = [
            '/^(.*)(1[0-9])$/' => '\1\2 лет',
            '/^(.*)([1])$/'    => '\1\2 год',
            '/^(.*)([2-4])$/'  => '\1\2 года',
            '/^(.*)([05-9])$/' => '\1\2 лет'
        ];
        foreach ($replaces as $pattern => $replace) {
            $exp = preg_replace($pattern, $replace, $exp);
        }

        return $exp;
    }

    public function getTypeAttribute()
    {
        return 'доктор';
    }

    public function getHumanAmbulatoryAttribute()
    {
        if ($this->ambulatory == 1){
            $humanAmbulatory = 'Да';
        } else {
            $humanAmbulatory = 'Нет';
        }

        return $humanAmbulatory;
    }

    public function getHumanChildAttribute()
    {
        if ($this->child == 1){
            $humanChild = 'Да';
        } else {
            $humanChild = 'Нет';
        }

        return $humanChild;
    }

    public function updateCommentRate()
    {
        $comments = $this->publicComments()->get();
        $sumRate = $comments->sum('user_rate');
        $countRate = $comments->count();
        $avgRate = $countRate <= 0 ? 0 : $sumRate / $countRate;
        $rate = MathHelper::wilsonScore($sumRate, $countRate);
        $this->rate = $rate / 2;
        $this->avg_rate = $avgRate / 2;
        $this->save();
    }

    public function publicComments()
    {
        return $this->comments()->where('comments.status', 1)->orderBy('updated_at', 'desc');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'owner');
    }

    public function setPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['phone'] = null;
    }

    const CONTENTS = [
        'about_text'     => 'О враче',
        'treatment_text' => 'Лечение заболеваний',
        'exp_text'       => 'Опыт работы',
        'grad_text'      => 'Образование',
        'certs_text'     => 'Дипломы и сертификаты',
        'community_text' => 'Клубы и сообщества'
    ];

    public function getMetaTitle()
    {
        $skills_result = [];
        $skills = $this->skills()->get();
        foreach ($skills as $skill) {
            $skills_result[] = $skill->name;
        }
        return empty($this->meta_title)
            ? ($this->firstname . ' ' . $this->lastname . ' - ' . implode(", ", $skills_result) . ' - ' . $this->city->name)
            : $this->meta_title;
    }

    public function getMetaDescription()
    {
        $skills_result = [];
        $skills = $this->skills()->get();
        foreach ($skills as $skill) {
            $skills_result[] = $skill->name;
        }
        return empty($this->meta_desc)
            ? ($this->firstname . ' ' . $this->lastname . ' - ' . implode(", ", $skills_result)) . ". " . SeoMetadataHelper::DEFAULT_DESCRIPTION
            : $this->meta_desc;
    }

    public function getMetaKeywords()
    {
        return empty($this->meta_key) ? null : $this->meta_key;
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
