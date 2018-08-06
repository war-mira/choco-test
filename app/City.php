<?php

namespace App;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;

/**
 * App\City
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $position
 * @property string|null $name Название города
 * @property string|null $alias Алиас
 * @property string|null $type
 * @property int|null $geocode Гео код города
 * @property int|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereGeocode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\City[] $children
 * @property-read mixed $child_ids
 * @property-read mixed $href
 * @property-read \App\City|null $parent
 */
class City extends Model
{
    protected $table = 'cities';

    protected $appends = ['href'];

    const ACTIVE = 1;

    public function parent()
    {
        return $this->belongsTo(City::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(City::class, 'parent_id', 'id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'parent_id', 'id');
    }

    public function getChildIdsAttribute()
    {
        $ids = collect([$this->id]);
        foreach ($this->children as $child) {
            $ids->merge($child->child_ids);
        }

        return $ids;
    }

    public function getHrefAttribute()
    {
        return route('doctors.list', ['city' => $this->alias]);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }
}
