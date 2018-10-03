<?php

namespace App\Model\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\System\Status
 *
 * @mixin \Eloquent
 */
class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'target_type',
        'target_column',
        'code',
        'name',
        'description'
    ];
    public $timestamps = false;
}
