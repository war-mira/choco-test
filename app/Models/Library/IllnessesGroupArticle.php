<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;

class IllnessesGroupArticle extends Model
{
    protected $table = 'illnesses_group_articles';

    protected $fillable = [
      'name',
      'illnesses_group_id',
      'description',
      'description-lite',
      'alias',
      'meta_title',
      'meta_key',
      'meta_desc',
      'created_at',
      'updated_at',
      'image'
    ];

    public function illnessesGroup()
    {
        return $this->belongsTo('App\Models\Library\IllnessesGroup', 'illnesses_group_id', 'id');
    }
}
