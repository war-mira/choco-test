<?php

namespace App\Models\Library;

use App\Components\Longrid\GridModel;
use App\Interfaces\ISeoMetadata;
use Illuminate\Database\Eloquent\Model;

class IllnessesGroupArticle extends Model implements ISeoMetadata
{
    use GridModel;
    protected $table = 'illnesses_group_articles';

    protected $fillable = [
      'name',
      'illnesses_group_id',
      'content',
      'description',
      'description-lite',
      'alias',
      'meta_title',
      'meta_key',
      'meta_desc',
      'created_at',
        'active',
      'updated_at',
      'image'
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Library\IllnessesGroup', 'illnesses_group_id', 'id');
    }

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function getMetaDescription()
    {
        return $this->meta_desc;
    }

    public function getMetaKeywords()
    {
        return $this->meta_key;
    }

    public function getMetaHeader()
    {
        return $this->name;
    }
    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
    public function getSeoText()
    {
        return '';
    }
}
