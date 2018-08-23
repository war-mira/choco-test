<?php

namespace App\Http\Requests\Doctor;


use App\Http\Requests\Filter;
use App\Skill;
use Carbon\Carbon;

class DoctorFilters extends Filter{


    public function q($search)
    {
        return $this->builder->where(function ($q) use ($search){
            return $q->where('firstname',$search)
                ->orWhere('lastname',$search)
                ->orWhere('patronimyc',$search)
                ;
        });
    }


    public function child($flag = true)
    {
        return $this->builder->where('child',$flag);
    }


    public function ambulatory($flag = true)
    {
        return $this->builder->where('ambulatory',$flag);
    }


    public function exp_range($range = [0,0])
    {
        $price = explode(':',$range);
        if(count($price)==2){

            $price[0] = Carbon::now()->subYears($price[0]);
            $price[1] = Carbon::now()->subYears($price[2]);

            return $this->builder->whereBetween('works_since',$price);
        }

        return $this->builder;
    }


    public function price_range($range = [0,0])
    {
        $price = explode(':',$range);
        return count($price)==2 ? $this->builder->whereBetween('price',$price) : $this->builder;
    }


    public function rate_range($range = [0,0])
    {
        $price = explode(':',$range);
        return count($price)==2 ? $this->builder->whereBetween('rate',$price) : $this->builder;
    }



    public function price($price)
    {
        return $this->builder->where('price',$price);
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



    public function user($user)
    {
        if (!$user)
            return $this->builder;

        return $this->builder->{is_array($user)?'whereIn':'where'}('user_id',$user);
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


    public function district($district = [])
    {
        if (!$district)
            return $this->builder;

        return $this->builder->whereHas('medcenters',function ($query) use ($district){
            return $query->{is_array($district)?'whereIn':'where'}('district_id',$district);
        });
    }

    public function illnesses($illness = [])
    {
        if (!$illness)
            return $this->builder;

        return $this->builder->whereHas('illnesses',function ($query) use ($illness){
            return $query->{is_array($illness)?'whereIn':'where'}('alias',$illness);
        });
    }

    public function illness_groups($groups = [])
    {
        if (!$groups)
            return $this->builder;

        return $this->builder->whereHas('illnesses',function ($query) use ($groups){
            return $query->{is_array($groups)?'whereIn':'where'}('group_id',$groups);
        });
    }

    public function medcenter($medcenter = [])
    {
        if (!$medcenter)
            return $this->builder;

        return $this->builder->whereHas('medcenters',function ($query) use ($medcenter){
            return $query->{is_array($medcenter)?'whereIn':'where'}('id',$medcenter);
        });
    }

    public function qualification($qualification = [])
    {
        if (!$qualification)
            return $this->builder;

        return $this->builder->whereHas('qualifications',function ($query) use ($qualification){
            return $query->{is_array($qualification)?'whereIn':'where'}('id',$qualification);
        });
    }

}