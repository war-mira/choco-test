<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagParameter extends Model
{
    protected $table = 'tag_parameters';
    protected $fillable = [
        'tag_id',
        'name',
        'type',
        'required'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function entities()
    {
        return $this->hasManyThrough(TaggedEntity::class, Tag::class);
    }

    public function attributes()
    {
        return $this->hasMany(TagAttribute::class, 'tag_parameter_id', 'id');
    }
}
