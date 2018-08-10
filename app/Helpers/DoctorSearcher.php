<?php


namespace App\Helpers;


use App\Skill;

class DoctorSearcher
{
    public function __construct($input)
    {
        $this->input = $input;

        $this->filter = collect([]);
        $this->log = collect([]);
        $this->stack = collect([]);

        $this->updateStack();
    }

    public $input = [];
    public $filter = [];
    public $log = [];
    public $stack = [];

    public function updateStack()
    {
        $this->stack = collect($this->input)->filter()->transform(function ($item){
            return  explode('-',str_replace_array(' ',['-'], $item));
        });
    }

    public function lex()
    {
        // 1st step - unify words (translit, mistakes etc.)
        $this->stack = $this->stack->transform(function ($item,$index){
            $item = collect($item)->transform(function ($word){

                $word = $this->autoCorrect(str_slug(mb_strtolower($word)));
                if(!$this->locateFilter($word))
                    return trim($word);
            });

            $rest = implode('-',$item->filter()->toArray());

            if($this->locateFilter($rest)){
                $this->input[$index] = null;
                return;
            }
            $this->input[$index] = $rest;
            return $item->filter();
        })->filter();

        return $this;
    }

    public function skills()
    {
        foreach ($this->input as $key=>$str){
            if($str!='' && $this->findInSkills($str))
                $this->input[$key] = null;
        }
        $this->updateStack();

        $this->stack->flatten()->filter()->each(function ($item){
                $this->findInSkills($item);
        });

        return $this;
    }


    public function autoCorrect($input)
    {
        if($mark = $this->dictionary[$input]??null)
            $this->log->push(['auto correction'=>[$input=>$mark]]);

        return $mark??$input;
    }


    public function locateFilter($input)
    {
        if($mark = $this->keyWords[$input]??false){
            $this->filter = $this->filter->merge($mark);
            $this->log->push(['filter found'=>[$input=>$mark]]);
        }

        return $mark;
    }


    public function findInSkills($input)
    {
        $skills = Skill::where('alias','like',"%$input%");
        if($this->filter->has('child'))
            $skills->orWhere('alias','like',"%detskiy-$input%");

        $mark = $skills->get(['id','name']);
        $this->filter = $this->filter->merge(['skills'=>$mark->pluck('id')]);
        $this->log->push(['Skills found'=>[$input=>$mark->pluck('name')]]);



        return $mark;
    }

    public $dictionary = [
        'detskyi'=>'detskiy',
    ];


    public $keyWords = [
        'detskiy'=>['child'=>1],
        'kruglosutochno'=>['worktime'=>'24h'],
        'na-dom'=>['ambulatory'=>1],
    ];
}