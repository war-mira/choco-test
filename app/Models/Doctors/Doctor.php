<?php

namespace App\Models\Doctors;

use App\Enums\HasCustomListFields;
use App\Models\Doctors\Traits\Attribute\DoctorAttribute;
use App\Models\Doctors\Traits\Method\DoctorMethod;
use App\Models\Doctors\Traits\Relationship\DoctorRelationship;
use App\Models\Doctors\Traits\Scope\DoctorScope;
use App\Traits\Eloquent\FilterScopes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 * @package App\Models\Doctors
 */
class Doctor extends Model
{
    use FilterScopes,
        HasCustomListFields,
        DoctorAttribute,
        DoctorRelationship,
        DoctorScope,
        DoctorMethod;

    const CONTENTS = [
        'about_text'     => 'О враче',
        'treatment_text' => 'Лечение заболеваний',
        'exp_text'       => 'Опыт работы',
        'grad_text'      => 'Образование',
        'certs_text'     => 'Дипломы и сертификаты',
        'community_text' => 'Клубы и сообщества'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'child'   => 'int',
        'city_id' => 'int',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'avatar'      => 'images/no-userpic.gif',
        'works_since' => '2000-01-01',
        'rate'        => 0,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'href'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'alias';
    }

    public function getHrefAttribute()
    {
        dd($this->city);
        return route('doctor.item', ['city' => $this->city->alias, 'doctor' => $this->alias]);
    }}
