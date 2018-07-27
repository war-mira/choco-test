<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Model;

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
      'updated_at'
    ];

    protected $table = 'illnesses_groups';

    public function ilnesses()
    {
        return $this->hasMany('App\Models\Library\Illness', 'group_id', 'id');
    }
}
