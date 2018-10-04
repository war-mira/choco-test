<?php

namespace App\Models\Doctors\Traits\Attribute;

use App\Enums\DoctorStatus;
use App\Helpers\FormatHelper;
use Carbon\Carbon;

/**
 * Trait DoctorAttribute
 * @package App\Models\Doctors\Traits\Attribute
 */
trait DoctorAttribute
{
    /**
     * @return string
     */
    public function getTypeAttribute()
    {
        return 'доктор';
    }

    /**
     * @return int
     */
    public function getRateAttribute()
    {
        $rate = $this->attributes['rate'];
        $rate = $rate < 0 ? 0 : $rate;
        $rate = $rate > 10 ? 10 : $rate;

        return $rate;
    }

    /**
     * @param $value
     */
    public function setWorksSinceYearAttribute($value)
    {
        $this->works_since = Carbon::createFromDate($value)->format('Y') . "-01-01";
    }

    /**
     * @return string
     */
    public function getWorksSinceYearAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->works_since ?? '2000-01-01')->format('Y');
    }

    /**
     * @return string
     */
    public function getHrefAttribute()
    {
        return route('doctor.item', ['city' => $this->city, 'doctor' => $this]);
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    /**
     * @return bool|string
     */
    public function getContentDescriptionAttribute()
    {
        return substr(strip_tags(str_replace('\r\n', '', $this->content)), 0, 256);
    }

    /**
     * @return string
     */
    public function getAvatarAttribute()
    {
        return file_exists(public_path($this->attributes['avatar'])) ?
            asset($this->attributes['avatar']) :
            asset('images/no-userpic.gif');
    }

    /**
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return DoctorStatus::getDescription($this->status);
    }

    /**
     * @return null|string|string[]
     */
    public function getExpFormattedAttribute()
    {
        if ($this->works_since == null) {
            return "";
        }

        $exp = (string)(Carbon::now()->diffInYears(Carbon::createFromFormat('Y-m-d', $this->works_since)));

        $replaces = [
            '/^(.*)(1[0-9])$/' => '\1\2 лет',
            '/^(.*)([1])$/'    => '\1\2 год',
            '/^(.*)([2-4])$/'  => '\1\2 года',
            '/^(.*)([05-9])$/' => '\1\2 лет',
        ];

        foreach ($replaces as $pattern => $replace) {
            $exp = preg_replace($pattern, $replace, $exp);
        }

        return $exp;
    }

    /**
     * @param $phone
     */
    public function setPhoneAttribute($phone)
    {
        if (isset($phone))
            $this->attributes['phone'] = FormatHelper::phone($phone);
        else
            $this->attributes['phone'] = null;
    }
}
