<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\District
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $city_id
 * @property string|null $name
 */
class District extends Model
{
    protected $table = 'districts';

    protected $appends = ['href'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

}
