<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TagAttribute extends Model
{
    protected $table = 'tag_attributes';
    protected $fillable = [
        'tag_parameter_id',
        'tagged_entity_id',
        'value'
    ];

    public function getValueAttribute()
    {
        $type = $this->getValueType();
        return $this->getValueAs($type);
    }

    public function getValueType()
    {
        return $this->param()->first(['type'])->type;
    }

    public function param()
    {
        return $this->belongsTo(TagParameter::class, 'tag_parameter_id', 'id');
    }

    public function getValueAs($type = null)
    {
        $type = $type ?? $this->getValueType();
        if ($type == null) {
            $castVal = $this->attributes['value'];
        } elseif (in_array($type, ['int', 'float', 'bool', 'str'])) {
            $castFunc = $type . 'val';
            $castVal = $castFunc($this->attributes['value']);
        } elseif ($type[strlen($type) - 1] == ')') {
            list($type, $format) = explode('(', substr($type, 0, strlen($type) - 1));
            if ($type == 'date') {
                $castVal = $this->getValueAsDate($format);
            }

        } else {
            $castVal = $this->attributes['value'];
        }
        return $castVal;
    }

    public function getValueAsDate($format)
    {
        return Carbon::createFromFormat($format . '|', $this->attributes['value']);
    }

    public function setValueAs($value, $type = null)
    {
        $type = $type ?? $this->getValueType();
        if ($type == null) {
            $castVal = $value;
        } elseif (in_array($type, ['int', 'float', 'bool', 'str'])) {
            $castFunc = $type . 'val';
            $castVal = $castFunc($value);
        } elseif ($type[strlen($type) - 1] == ')') {
            list($type, $format) = explode('(', substr($type, 0, strlen($type) - 1));
            if ($type == 'date') {
                $castVal = $value->format($format);
            }

        } else {
            $castVal = $value;
        }
        $this->attributes['value'] = $castVal;
        return $this;
    }

    public function tag()
    {
        return Tag::whereHas('params', function (\Illuminate\Database\Query\Builder $query) {
            $query->where('tag_parameters.id', $this->tag_parameter_id);
        });
    }

    public function entity()
    {
        return $this->belongsTo(TaggedEntity::class, 'tagged_entity_id', 'id');
    }
}
