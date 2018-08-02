<?php

namespace App\Http\Requests\Doctor;


use App\Http\Requests\Filter;
use App\Skill;

class DoctorFilters extends Filter{

    public function user($user)
    {
        if (!$user)
            return $this->builder;

        return $this->builder->{is_array($user)?'whereIn':'where'}('user_id',$user);
    }




    public function child()
    {
        return $this->builder;
    }


    public function ambulatory()
    {
        return $this->builder;
    }


    public function exp_range()
    {
        return $this->builder;
    }


    public function price_range()
    {
        return $this->builder;
    }


    public function rate_range()
    {
        return $this->builder;
    }



    public function q()
    {
        return $this->builder;
    }


    public function price($price)
    {
        return $this->builder->where('price',$price);
    }


    public function city($city=null)
    {
        if (!$city || $city==1)
            return $this->builder;

        return $this->builder->where('doctors.city_id',$city);
    }


    public function skills($skills = [])
    {
        if (!$skills)
            return $this->builder;

        return $this->builder->whereHas('skills',function ($query) use ($skills){
            return $query->{is_array($skills)?'whereIn':'where'}('alias',$skills);
        });
    }

    public function tops($skill = [])
    {
        if (!$skill)
            return $this->builder;

        $skill = is_array($skill)?$skill:[$skill];
        $tops = Skill::find($skill)->pluck('top_doctors')->flatten();

        return $this->builder->whereIn('doctors.id',$tops);
    }


    public function comercials($flag = 1)
    {
        return $this->builder->{$flag==1?'where':'whereNot'}('doctors.comercial',1);
    }
}