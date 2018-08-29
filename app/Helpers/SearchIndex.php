<?php

namespace App\Helpers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class SearchIndex
{
    protected $prefix = 'search.index2';
    protected $model = '';
    protected $attributes = [];
    protected $attribute = '';

    public $ids = [];

    public $data = [];

    public $post = [];
    public $fetched_post = null;
    public $topics = [];
    public $id_field;


    /**
     * SearchIndex constructor.
     * @param $model
     * @param array $attributes [[attribute => parse_type], ...]
     * @param string $id_field
     */
    public function __construct($model, $attributes = [], $id_field = 'id')
    {
        $this->ids = collect([]);

        $this->model = $model;
        $this->id_field = $id_field;
        $this->attributes = collect($attributes);
    }


    /**
     * Return Redis key string prefix
     *
     * @param string $action
     * @param null $attrib
     * @return string
     */
    public function _key($action = 'list', $attrib = null)
    {
        return implode(':',[
            $this->prefix,
            $this->model,
            $attrib ?? $this->attribute,
            $action
        ]);
    }


    /**
     * Register record in Eloquent model in it's index
     *
     * ** List of all attribute values with items count
     * ** List of model's ids with current value
     * ** Cache data by id with value for result caption
     *
     * @param $value
     * @param $key
     * @param null $info
     */
    public function storeRecord($value, $key, $info = null)
    {
        if(trim($value)=='')
            return;

        Redis::publish('search log',sprintf(
        'Storing record: %s - %s',
                $value,$key
            )
        );

        Redis::zincrby($this->_key('values'),1,$value);
        Redis::sadd($this->_key('keys:').mb_strtolower($value),$key);
        Redis::zadd($this->_key('list'),$key,json_encode($info??$value));

        $this->storeWordAutocomplete($value);
    }


    public function storeWordAutocomplete($word, $key=null)
    {
        // TODO: generate synonim & normalize dictionary
        // TODO: prepare wulti word combinations
        $normalized = str_replace(' ','',
            trim(
                mb_strtolower($word)
            )
        );

        // translit
        $index = str_slug($normalized).':'.$word;
        Redis::zadd($this->_key('autocomplete'),0,$index);

        // keys switched EN


        // iterates for each letter
        for($i = 1; $i<=strlen($normalized); $i++){
            $index = substr($normalized,0,$i).':'.$word;
            Redis::zadd($this->_key('autocomplete'),0,$index);
        }

    }


    /**
     * Get record caption for search result
     *
     * @param $id
     * @return mixed
     */
    public function getRecordInfo($id)
    {
        return json_decode(Redis::zrangebyscore($this->_key(),$id,$id)[0]);
    }


    /**
     * List of attribute values with counters
     *
     * @param null $attrib
     * @return mixed
     */
    public function getValues($attrib = null)
    {
        return Redis::zrevrangebyscore($this->_key('values',$attrib),'+inf','-inf','WITHSCORES');
    }




    /*
      wot: Search scopes
    */

    /**
     * Find ids with current attribute set
     *
     * @param array $values in format: [[attribute => value], ...]
     * @return array|mixed
     */
    public function withTags($values = [])
    {
        if(count($values)==0) return $this;

        $tags = collect($values)->transform(function ($value,$attr) {

            return $this->_key(
                'keys:',
                is_int($attr)?$this->attribute:$attr
                ).$value;

        })->toArray();

        $ids = call_user_func_array( [Redis::class, "sinter"],
            $tags
        );
        $this->ids = $this->ids->merge($ids);

        return $this;
    }


    /**
     * Fetch caption info for $limit number results
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function get($limit = 50)
    {
        return collect($this->ids)
            ->take($limit)
            ->mapWithKeys(function ($id){
                return [$id=>$this->getRecordInfo($id)];
            });
    }


    /**
     * Parse types:
     * ** self -
     * ** any else means - loop for each item in attribute and use parse type as value field
     *
     * @param $data
     * @return SearchIndex
     */
    public function addToIndex($data)
    {
        ($data->count() ? $data : collect($data))->each(function ($record){

            $this->attributes->each(function ($parse_type, $attribute) use ($record) {

                $this->attribute = $attribute;
                $attrVal = $record->{$attribute};

                $id = $record->{$this->id_field};

                switch ($parse_type){
                    case 'self':
                        $this->storeRecord(
                            $record->{$attribute},
                            $id
                        );
                        break;
                    case 'api': break; //TODO: reserved
                    default:

//                        dd();

                        Redis::publish('search log', sprintf(
                            'Process submodel %s: %s',
                            $attribute, $parse_type
                        ));

                        // TODO: belongsTo
                        ($attrVal->count()?$attrVal:collect($attrVal))
                            ->each(function ($rec) use ($id, $parse_type){

                                Redis::publish('search log', sprintf(
                                    '------------ %s = %s',
                                    $parse_type, is_array($rec)?$rec[$parse_type]:$rec->{$parse_type}
                                ));


                                $this->storeRecord(
                                    is_array($rec)?$rec[$parse_type]:$rec->{$parse_type},
                                    $id
                                );
                        });

                }


            });

            Redis::publish('search indexed',1);

        });
        return $this;
    }


    public function qwerty($en)
    {
        $rus = ['й', 'ц', 'у', 'к', 'е', 'н', 'г', 'ш', 'щ', 'з', 'х', 'ъ', 'ф', 'ы', 'в', 'а', 'п', 'р', 'о', 'л', 'д', 'ж', 'э', 'я', 'ч', 'с', 'м', 'и', 'т', 'ь', 'б', 'ю', 'Й', 'Ц', 'У', 'К', 'Е', 'Н', 'Г', 'Ш', 'Щ', 'З', 'Х', 'Ъ', 'Ф', 'Ы', 'В', 'А', 'П', 'Р', 'О', 'Л', 'Д', 'Ж', 'Э', 'Я', 'Ч', 'С', 'М', 'И', 'Т', 'Ь', 'Б', 'Ю', ',' ,'ё', 'Ё'];
        $eng = ['q','w','e','r','t','y','u','i','o','p','[',']','a','s','d','f','g','h','j','k','l',';',"'",'z','x','c','v','b','n','m',',','.', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', '{', '}', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', ':', '"', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', '<', '>', '?', '`', '~'];

        return $rus[array_search($en,$eng)];
    }

}