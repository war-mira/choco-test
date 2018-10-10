<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IllnessesGroup extends Model
{
    protected $fillable = [
      'name',
      'description',
      'description-lite',
      'alias',
      'meta_title',
      'meta_key',
      'meta_desc',
      'created_at',
      'updated_at',
      'active'
    ];

    protected $table = 'illnesses_groups';

    public function illnesses()
    {
        return $this->hasMany('App\Models\Library\Illness', 'group_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Library\IllnessesGroupArticle', 'illnesses_group_id', 'id');
    }



    public function limitedArticles()
    {
        return $this->articles()->take(3)->get();
    }
}
