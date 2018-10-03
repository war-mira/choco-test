<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaEvent extends Model
{
    protected $table = 'ga_events';
    protected $fillable = [
        'source_type',
        'source_id',
        'payload'
    ];

    public function source()
    {
        return $this->morphTo();
    }


    public $timestamps = true;
}
