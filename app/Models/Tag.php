<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'description',
        'type'
    ];

    public function entities()
    {
        return $this->hasMany(TaggedEntity::class, 'tag_id', 'id');
    }

    public function params()
    {
        return $this->hasMany(TagParameter::class, 'tag_id', 'id');
    }
}
