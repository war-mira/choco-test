<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Uniqueip extends Model
{
    protected $table = 'uniqueip';
    protected $fillable = [
        'doctor',
        'like_dis'
    ];
}