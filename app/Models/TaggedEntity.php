<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaggedEntity extends Model
{
    protected $table = 'tagged_entities';
    protected $fillable = [
        'tag_id',
        'entity_type',
        'entity_id'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function entity()
    {
        return $this->morphTo();
    }

    public function setTagAttr($name, $value, $save = true, $cast = null)
    {
        /** @var TagParameter $param */
        $param = TagParameter::query()->where([['name', '=', $name], ['tag_id', '=', $this->tag_id]])->firstOrFail();
        return $this->setTagParam($param, $value, $save, $cast);
    }

    public function setTagParam(TagParameter $param, $value, $save = true, $cast = null)
    {
        $cast = is_string($save) ? $save : $cast;
        $save = is_string($save) ? true : $save;
        /** @var TagAttribute $attribute */
        $attribute = $this->attributes()->firstOrNew(['tag_parameter_id' => $param->id]);
        $attribute->setValueAs($value, $cast);
        if ($save) $attribute->save();
        return $attribute;
    }

    public function attributes()
    {
        return $this->hasMany(TagAttribute::class, 'tagged_entity_id', 'id');
    }

    public function getTagAttr($name, $cast = null)//cast not recommended
    {
        /** @var TagParameter $param */
        $param = TagParameter::query()->where([['name', '=', $name], ['tag_id', '=', $this->tag_id]])->firstOrFail();
        return $this->getTagParam($param, $cast);
    }

    public function getTagParam(TagParameter $param, $cast = null)//cast not recommended
    {
        /** @var TagAttribute $attribute */
        $attribute = $this->attributes()->where('tag_parameter_id', $param->id)->firstOrFail();
        return $attribute->getValueAs($cast);
    }

}
