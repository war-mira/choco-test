<?php

namespace App;

use App\Helpers\SessionContext;
use App\Interfaces\ISeoMetadata;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use morphos\Russian\GeographicalNamesInflection;
use morphos\Russian\NounPluralization;

/**
 * App\Skills
 *
 * @mixin \Eloquent
 * @property int                                                         $id
 * @property string|null                                                 $name Название
 * @property string|null                                                 $alias Название
 * @property string|null                                                 $description Описание
 * @property int                                                         $position
 * @property int                                                         $category
 * @property string                                                      $seo_title
 * @property string                                                      $seo_h1
 * @property string                                                      $seo_keywords
 * @property string                                                      $seo_description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereSeoH1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereSeoTitle($value)
 * @property array                                                       $top_doctors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Doctor[] $doctors
 * @property-read mixed                                                  $href
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill whereTopDoctors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Skill withFirstLetters()
 */
class Skill extends Model implements ISeoMetadata
{
    public $timestamps = false;
    protected $table = 'skills';
    protected $fillable = [
        'id',
        'alias',
        'description',
        'name',
        'meta_title',
        'meta_key',
        'meta_desc',
        'top_doctors',
        'seo_text',
        'seo_h1',
    ];
    protected $casts = [
        'top_doctors' => 'json'
    ];
    protected $appends = [
//        'href'
    ];

    public static function firstLetters()
    {
        return self::orderBy('name')->selectRaw('SUBSTRING(`name`,1,1) as \'first_letter\'')->distinct()->get(['first_letter'])->makeHidden('href')->pluck('first_letter');
    }

    public function getHrefAttribute()
    {
        return route('doctors.list', ['skill' => $this->alias]);
    }

    public function topDoctors()
    {
        $topDoctors = collect([]);
        foreach ($this->top_doctors ?? [] as $key => $id) {
            $topDoctors[$key] = Doctor::find($id);
        }
        return $topDoctors;
    }



    public function noTopDoctors()
    {
        $allDoctors = $this->publicDoctors()->where('status', 1);
        $orderedDoctors = $allDoctors->whereNotIn('doctors.id', $this->top_doctors ?? []);
        return $orderedDoctors;
    }

    public function publicDoctors()
    {
        $allDoctors = $this->doctors()->where('status', 1);
        return $allDoctors;

    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctors_skills', 'skill_id', 'doctor_id');
    }

    public function scopeWithFirstLetters(Builder $query)
    {
        return $query->addSelect(\DB::raw('SUBSTRING(skills.name,1,1) as first_letter'));
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
        return empty($this->meta_title)
            ? ($this->name . ' :city_name.' . $this->name . ' - отзывы о лучших врачах, фото, цены - iDoctor.kz')
            : $this->meta_title;
    }

    public function getMetaDescription()
    {
        return empty($this->meta_desc) ? $this->description : $this->meta_desc;
    }

    public function getMetaKeywords()
    {
        return empty($this->meta_key) ? $this->name : $this->meta_key;
    }

    public function getMetaHeader()
    {
        $city = SessionContext::city();
        return empty($this->seo_h1) ?  NounPluralization::getCase($this->name, 'именительный').' в '. GeographicalNamesInflection::getCase($city->name, 'предложный'): $this->seo_h1;
    }

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
    public function getSeoText()
    {
        return empty($this->seo_text) ? '' : $this->seo_text;
    }

    public static function getList()
    {
      return   Skill::where('active',1)
          ->orderBy('name')
          ->active()
            ->get();
    }

}
