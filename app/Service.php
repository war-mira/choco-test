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


    public static $phones =  [
        884 => "+7 (727) 384–16–61",
        481 => "+7 (727) 384–16–61",
        532 => "+7 (727) 274–85–96",
        331 => "+7 (727) 303–33–33",
        518 => "7 (727) 260–98–48",
        0 => "8 (727) 394 2260",
        539 => "+7 (727) 248–30–07",
        582 => "+7 (727) 375–23–86",
        478 => "+7 (727) 375–23–86",
        495 => "+7 (727) 275–64–22",
        1401 => "+7 (727) 272–67–93"
    ];

    public static  function getPhone($id)
    {
        if(array_key_exists($id,self::$phones)){
            return self::$phones[$id];
        }
        return '';
    }
}
