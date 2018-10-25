<?php

namespace App;

use App\Interfaces\Replaceable;
use Illuminate\Database\Eloquent\Model;

class MedcenterType extends Model implements Replaceable
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'title',
        'alias',
        'active',
        'description',
        'keywords',
    ];

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    public function medcenters()
    {
        return $this->belongsToMany(Medcenter::class,'medcenter_type','type_id','medcenter_id');
    }

    public function getTitle()
    {
        return $this->name;
    }
    public function mergeWithCustomPlaceholders($phs){
        $placeholder = [
            ':title' =>$this->name
        ];

        return array_merge($phs,$placeholder);
    }
}
