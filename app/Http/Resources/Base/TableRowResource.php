<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\Resource;

class TableRowResource extends Resource
{
    protected $visible = [];
    protected $appends = [];

    protected function getAppends($resource,$request){
        return $this->appends;
    }
    protected function getVisible($resource,$request){
        return $this->visible;
    }

    private function processVisible($resource,$request){
        $data = [];
        foreach ($this->getVisible($resource,$request) as $attribute){
            $data[$attribute] = $resource[$attribute] ?? null;
        }
        return $data;
    }

    private function processAppends($resource,$request){
        $data = [];
        foreach ($this->getAppends($resource,$request) as $key=>$value){
            if(is_callable($value)){
                $data[$key] = $value($resource);
            }
            elseif(is_numeric($key)){
                $data[$value] = $resource[$value] ?? null;
            }
            elseif(is_string($key)){
                $data[$key] = $value;
            }
        }
        return $data;
    }

    protected function getData($resource,$request){
        $visibleData = $this->processVisible($resource,$request);
        $appendsData = $this->processAppends($resource,$request);
        $data = array_merge($visibleData,$appendsData);
        return $data;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = $this->getData($this->resource,$request);
        return $array;
    }
}
