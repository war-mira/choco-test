<?php

use Illuminate\Support\Facades\URL;

class UserHrCourse extends Eloquent {

    protected $table = 'users_hr_courses';

    public function hrStudents()
    {
        return $this->belongsToMany('User', 'users_hr_courses', 'id', 'user_id');
    }

    public function student()
    {
        return $this->belongsTo('User','user_id')->select(array('id', 'username'));
    }


}
