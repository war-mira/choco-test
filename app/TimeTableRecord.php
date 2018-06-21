<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTableRecord extends Model
{
    protected $table = 'time_table_records';
    public $timestamps = true;

    protected $fillable = [
        'time_table_id',
        'day',
        'from_minutes',
        'to_minutes',
    ];

    public function setFromTimeAttribute($value)
    {
        list($hours, $minutes) = explode(':', $value);
        $minutes = $hours * 60 + $minutes;
        $this->from_minutes = $minutes;
    }

    public function getFromTimeAttribute()
    {
        $minutes = $this->from_minutes;
        $hours = str_pad(round($minutes / 60), 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes % 60, 2, "0", STR_PAD_LEFT);
        return $hours . ":" . $minutes;
    }

    public function setToTimeAttribute($value)
    {
        list($hours, $minutes) = explode(':', $value);
        $minutes = $hours * 60 + $minutes;
        $this->to_minutes = $minutes;
    }

    public function getToTimeAttribute()
    {
        $minutes = $this->to_minutes;
        $hours = str_pad(round($minutes / 60), 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes % 60, 2, "0", STR_PAD_LEFT);
        return $hours . ":" . $minutes;
    }


}
