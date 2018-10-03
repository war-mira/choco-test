<?php

namespace App\Models\Doctors\Traits\Relationship;

use App\City;
use App\Comment;
use App\Medcenter;
use App\Model\ServiceItem;
use App\Models\Doctors\DoctorJob;
use App\Models\TaggedEntity;
use App\Order;
use App\Skill;
use App\User;

/**
 * Trait DoctorRelationship
 * @package App\Models\Doctors\Traits\Relationship
 */
trait DoctorRelationship
{
    /**
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'doc_id', 'id');
    }

    /**
     * @return mixed
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'doctors_skills', 'doctor_id', 'skill_id')
                    ->withPivot(['weight']);
    }

    /**
     * @return mixed
     */
    public function jobs()
    {
        return $this->hasMany(DoctorJob::class);
    }

    /**
     * @return mixed
     */
    public function medCenters()
    {
        return $this->belongsToMany(Medcenter::class, 'doctor_jobs', 'doctor_id', 'medcenter_id')
                    ->withTimestamps()
                    ->withPivot(['id', 'medcenter_id', 'color']);
    }

    /**
     * @return mixed
     */
    public function items()
    {
        return $this->morphMany(ServiceItem::class, 'vendor');
    }

    /**
     * @return mixed
     */
    public function tags()
    {
        return $this->morphMany(TaggedEntity::class, 'entity');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'owner');
    }

    /**
     * @return mixed
     */
    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * @return mixed
     */
    public function updated_by()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
