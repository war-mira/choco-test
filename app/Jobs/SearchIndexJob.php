<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;

class SearchIndexJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $data;
    public $config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($config, $data)
    {
        $this->data = $data;
        $this->config = $config;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::publish('search log','Data chunk processing...');

        $index = new \App\Helpers\SearchIndex(
            $this->config['model'],
            $this->config['fields']
        );

        $index->addToIndex($this->data);

//        $this->data->each(function ($itm){
//            Redis::zadd("search.index2:{$this->config['model']}-info",$itm->id, json_encode($itm));
//        });

        Redis::publish('search indexed pages',1);

    }
}
