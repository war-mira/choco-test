<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    public function group()
    {
        return $this->hasOne(ServiceGroup::class,'id','group_id');
    }

    public function medcenters()
    {
        return $this->belongsToMany(Medcenter::class,'service_medcenter','service_id','medcenter_id')
            ->withPivot(['price']);
    }
    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
}
