<?php

namespace App\Models\Library;

use App\Doctor;
use App\Interfaces\ISeoMetadata;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model implements ISeoMetadata
{
    protected $fillable = [
        'group_id',
        'name',
        'alias',
        'description-lite',
        'description',
        'meta_title',
        'meta_key',
        'meta_desc',
        'created_at',
        'updated_at',
        'image',
        'active'
    ];

    protected $table = 'illnesses';

    public function group()
    {
        return $this->belongsTo(IllnessesGroup::class, 'group_id', 'id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctors_illnesses', 'illness_id', 'doctor_id');
    }

    public function scopeGetByLetter($query, $letter)
    {
      $illnesses = $query->where('active', 1)->where('name', 'like', $letter.'%');

      return $illnesses;
    }



    public function getMetaTitle()
    {
        return $this->name." - симптомы и лечение, причины, диагностика заболевания - iDoctor.kz";
    }

    public function getMetaDescription()
    {
        return "{$this->name}. Первые признаки и симптомы болезни. Профилактика и лечение. Что делать при диагнозе {$this->name}. Подробнее о болезни на iDoctor.kz.";
    }

    public function getMetaKeywords()
    {
        return "{$this->name} лечение, {$this->name} симптомы, {$this->name} профилактика и лечение, признаки {$this->name}, перарвые признаки {$this->name}";
    }

    public function getMetaHeader()
    {
        return $this->name;
    }

    public function getSeoText()
    {
        return '';
    }
}
