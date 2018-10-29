<?php

namespace App\Models\Library;

use App\Components\Longrid\GridModel;
use App\Doctor;
use App\Interfaces\ISeoMetadata;
use App\Interfaces\Replaceable;
use Illuminate\Database\Eloquent\Model;
use morphos\Russian\GeographicalNamesInflection;

class Illness extends Model implements ISeoMetadata,Replaceable
{
    use GridModel;
    protected $fillable = [
        'group_id',
        'name',
        'alias',
        'content',
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

    public function publisedDoctors()
    {
        return $this->doctors()->where('status', 1);
    }

    public function scopeGetByLetter($query, $letter)
    {
      $illnesses = $query->where('active', 1)->where('name', 'like', $letter.'%');

      return $illnesses;
    }

    public function scopeActive($query)
    {
        return $query->where('active',1);
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

    public function mergeWithCustomPlaceholders($phs){
        $title = GeographicalNamesInflection::getCase($this->name, 'родительный');
        $placeholder = [
            ':title' =>$title
        ];

        return array_merge($phs,$placeholder);
    }
}
