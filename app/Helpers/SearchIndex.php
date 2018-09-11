<?php

namespace App\Helpers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class SearchIndex
{
    protected $prefix = 'search.index4';
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
     * Return data struct type
     *
     * @param $data
     * @return string
     */
    public function _type($data)
    {
        $type = gettype($data);

        if($type == 'object')
            return class_basename($data);

        return $type;
    }


    public function _link($key)
    {
        return $key ? sprintf('%s:%s:%s:',
            $this->model,
            $this->attribute,
            $key
        ):'';
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


        if(Redis::sadd($this->_key('keys:').mb_strtolower($value),$key))
            Redis::zincrby($this->_key('values'),1,$value);

        Redis::sadd($this->_key('attribs',$key), $this->attribute.':'.$value);


        // TODO: check attribute options: autocomplete = true
//        $this->attributes[$this->attribute];
        if($this->attributes[$this->attribute]['autocomplete']??true)
            $this->storeWordSearchVariations($key,$value);
    }


    public function storeWordSearchVariations($key, $value)
    {
        $wordsList = collect([]);

        if($this->_type($value)=='string')
            $wordsList->push($value);


        // TODO: generate synonim & normalize dictionary
        $wordsList = $wordsList->merge($this->storeSynonyms($value));

        $wordsList->each(function ($keyword) use ($value) {

            $this->storeWordAutocomplete($keyword, $value);

            // TODO: multiple words -> one key
            collect(explode(' ',$keyword))->each(function ($word) use ($value) {
                $this->storeWordAutocomplete($word, $value);
            });

        });

    }

    public function storeSynonyms($value)
    {
        return collect($this->dictionaryValue($value));
    }

    public function getQwerty($word)
    {
        $word = preg_split('/(?<!^)(?!$)/u',$word);
        $en = '';
        foreach($word as $letter){
             $en .= $this->qwerty($letter);
        }


        return $en;
    }

    public function storeWordAutocomplete($word, $link=null)
    {

        $link = $this->_link($link);



        $normalized = str_replace(' ','',
            trim(
                mb_strtolower($word)
            )
        );
        $normalized = preg_replace('/[^\w\d\p{L}\p{Nd}]/u', '', $normalized);
//        preg_replace('/[^\w\d\p{L}\p{Nd}]/u', '', 'Пробная Test - !@#$%76');


        // translit
        $index = str_slug($normalized).':'.$link.$word;
        Redis::zadd($this->_key('autocomplete'),0,$index);

        // keys switched EN
        $index = $this->getQwerty($normalized).':'.$link.$word;
        Redis::zadd($this->_key('autocomplete'),0,$index);


        // iterates for each letter
        for($i = 1; $i<=strlen($normalized); $i++){
            $index = substr($normalized,0,$i).':'.$link.$word;
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
     * Add model record to index with predefined attributes
     *
     * @param $data
     * @return SearchIndex
     */
    public function addToIndex($data)
    {
        // Iterate all passed model records
        ($this->_type($data)=='Collection'?$data:collect($data))->each(function ($record){

            // Register record info in index
            Redis::set("{$this->prefix}:{$this->model}:{$record->id}-info", json_encode($record));
            Redis::zadd("{$this->prefix}:{$this->model}-indexed", time(), $record->id);

            // Iterates all predefined index attributes
            $this->attributes->each(function ($options, $attribute) use ($record) {

                // If attribute is presented without options
                if( gettype($attribute)=='integer' ){
                    $attribute = $options;
                    $options = [];
                }

                // Ignore if there's no attribute in record
                if(is_null($record->{$attribute}))
                    return;

                $this->attribute = $attribute;

                $value = $record->{$attribute};
                $id = $record->{$this->id_field};

                // Provide index strategy for different data types
                switch ($this->_type($value)){
                    case 'integer':
                    case 'boolean':
                    case 'string': $this->storeRecord($value, $id); break;
                    case 'Collection':
                    case 'array':
                    default: // It must be model
                       $this->storeAttributeCollection($options['value']??$attribute, collect($value), $id);
                }

            });
        });
        return $this;
    }


    /**
     * Iterate over submodel
     *
     * @param $attribute
     * @param Collection $data
     * @param $key
     */
    public function storeAttributeCollection($attribute, Collection $data, $key)
    {
        if($data->has($attribute))
            $this->storeRecord(
                $data[$attribute]??$data->{$attribute},
                $key
            );
        else
            $data->each(function ($rec) use ($data, $key, $attribute){
                $this->storeRecord(
                    $rec[$attribute]??$rec->{$attribute},
                    $key
                );
            });
    }


    public function dictionaryValue($in)
    {
        $dict = $this->attributes[$this->attribute]['dictionary']??[];
        return $dict[$in]??$in;
    }

    public function qwerty($en)
    {
        $rus = ['й', 'ц', 'у', 'к', 'е', 'н', 'г', 'ш', 'щ', 'з', 'х', 'ъ', 'ф', 'ы', 'в', 'а', 'п', 'р', 'о', 'л', 'д', 'ж', 'э', 'я', 'ч', 'с', 'м', 'и', 'т', 'ь', 'б', 'ю', 'Й', 'Ц', 'У', 'К', 'Е', 'Н', 'Г', 'Ш', 'Щ', 'З', 'Х', 'Ъ', 'Ф', 'Ы', 'В', 'А', 'П', 'Р', 'О', 'Л', 'Д', 'Ж', 'Э', 'Я', 'Ч', 'С', 'М', 'И', 'Т', 'Ь', 'Б', 'Ю', ',' ,'ё', 'Ё'];
        $eng = ['q','w','e','r','t','y','u','i','o','p','[',']','a','s','d','f','g','h','j','k','l',';',"'",'z','x','c','v','b','n','m',',','.', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', '{', '}', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', ':', '"', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', '<', '>', '?', '`', '~'];

        return $eng[array_search($en,$rus)]??$en;
    }

    public function log($data)
    {
        Redis::xadd('search-index:indexing-logs','*',is_array($data)?$data:['message'=>$data]);
        Redis::publish('search log',(string) $data);
    }
}