<?php


namespace App\Helpers;


use App\Models\Library\Illness;
use App\Skill;
use Illuminate\Support\Facades\Redis;

class DoctorSearcher
{
    public function __construct($input)
    {
        $this->input = $input;
        $this->original = $input;

        $this->filter = collect([]);
        $this->log = collect([]);
        $this->stack = collect([]);

        $this->updateStack();

        Redis::zincrby('documentSearcher:requests',1,json_encode($input));
    }

    public $input = [];
    public $original = [];
    public $filter = [];
    public $log = [];
    public $stack = [];


    /**
     *  Parse input string to stack array
     */
    public function updateStack()
    {
        $this->stack = collect($this->input)->filter()->transform(function ($item){
            return  explode('-',str_replace_array(' ',['-'], $item));
        });
    }


    /**
     * Run lexical correction of input and try to locate keywords
     * @return $this
     */
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


    /**
     * Find in doctor sub models (skills, clinic, illness etc...)
     * @return $this
     */
    public function context()
    {
        foreach ($this->input as $key=>$str){
            if($str!='' && $this->findInSkills($str)->count()>0)
                $this->input[$key] = null;

            else if($str!='' && $this->findInIllness($str)->count()>0)
                $this->input[$key] = null;
        }
        $this->updateStack();

        $this->stack->flatten()->filter()->each(function ($item){
                $this->findInSkills($item);
                $this->findInIllness($item);
        });

        return $this;
    }


    /**
     * Replace word if it's incorrect or synonym
     * @param $input
     * @return mixed|null
     */
    public function autoCorrect($input)
    {
        if($mark = $this->dictionary[$input]??null)
            $this->log->push(['auto correction'=>[$input=>$mark]]);

        return $mark??$input;
    }


    /**
     * If input word is key for filter - apply filter
     * @param $input
     * @return bool|mixed
     */
    public function locateFilter($input)
    {
        if($mark = $this->keyWords[$input]??false){
            $this->filter = $this->filter->merge($mark);
            $this->log->push(['filter found'=>[$input=>$mark]]);
        }

        return $mark;
    }


    /**
     * Search in skills
     * @param $input
     * @return Skill[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findInSkills($input)
    {
        // TODO: strict=1 search or like
        $skills = Skill::where('alias','like',"%$input%");

        // TODO: unify keywords & dependencies
        if($this->filter->has('child'))
            $skills->orWhere('alias','like',"%detskiy-$input%");

        $mark = $skills->get(['alias','name']);

        if($mark->count()>0){
            $this->filter = $this->filter->merge(['skills'=>$mark->pluck('alias')]);
            $this->log->push(['Skills found'=>[$input=>$mark->pluck('name')]]);
        }



        return $mark;
    }


    public function findInIllness($input)
    {
        // TODO: strict=1 search or like
        $skills = Illness::where('alias','like',"%$input%");

        $mark = $skills->get(['alias','name']);
        if($mark->count()>0){
            $this->filter = $this->filter->merge(['illness'=>$mark->pluck('alias')]);
            $this->log->push(['Illness found'=>[$input=>$mark->pluck('name')]]);
        }

        return $mark;
    }


    public function findInDistrics()
    {

    }


    public function registerLog()
    {
        // write to log
        // register unrecognized words searcher:unrecognized:{word} {incr} {input}
        $this->stack->flatten()->flatMap(function ($word){
            if(is_string($word)){
                Redis::sadd('documentSearcher:unrecoqnized:'.$word,json_encode($this->input));
                Redis::zincrby('documentSearcher:unrecoqnizedRequest',1,$word);
            }

        });
        Redis::publish('searcher log',json_encode($this->original));



    }

    public $dictionary = [
        'detskyi'=>'detskiy',

    ];


    public $keyWords = [
        'detskiy'=>['child'=>1],
        'kruglosutochno'=>['worktime'=>'24h'],
        'na-dom'=>['ambulatory'=>1],
    ];

    public $dependence = [
        'detskiy'=>[
            'skills'=>[
                'prefix'=>'detskiy-'
            ],
            'filters'=>['child'=>1],
            'synonyms'=>[
                'detskyi',
                'dlya-detey'
            ]
        ],
        '*-rayon'=>'{district}' // TODO: regexp to locate filter rule
    ];
}