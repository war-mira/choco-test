<?php

namespace App\Models\Library;

use App\Doctor;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
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
        'updated_at'
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

}
