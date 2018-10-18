<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    public $timestamps = false;

    public function services()
    {
        return $this->hasMany(Service::class,'group_id');
    }
    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

}