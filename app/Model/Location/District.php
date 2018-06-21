<?php

namespace App\Model\Location;

use App\Medcenter;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = [
        'city_id',
        'name'
    ];

    public function medcenters()
    {
        return $this->hasMany(Medcenter::class, 'district_id', 'id');
    }
}
