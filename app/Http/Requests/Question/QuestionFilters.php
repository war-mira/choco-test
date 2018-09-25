<?php

namespace App\Http\Requests\Question;


use App\Http\Requests\Filter;
use App\Skill;
use Carbon\Carbon;

class QuestionFilters extends Filter
{

    protected $key_to_key = [
        'date' => 'created_at'
    ];

    public function sort($by)
    {
        if($by == 'date' && $this->request->has('order')){
          return  $this->sortByDate($this->request->get('order'));
        }
       return $this->builder;
    }

    public function sortByDate($order)
    {
        return $this->builder->orderBy($this->getDbKey('date'),$order);
    }
    public function getDbKey($type)
    {
        if(array_key_exists($type,$this->key_to_key)){
            return $this->key_to_key[$type];
        } else{
            throw new \Exception('Key not found');
        }
    }

}