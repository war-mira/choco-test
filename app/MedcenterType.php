<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedcenterType extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'h1',
        'alias',
        'description',
        'keywords',
    ];


}
