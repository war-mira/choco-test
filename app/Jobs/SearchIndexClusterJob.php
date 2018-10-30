<?php

namespace App\Jobs;

use App\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;

class SearchIndexClusterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $city;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($city)
    {

        $this->city = $city;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $index_set = Doctor::public()->where('city_id',$this->city->id);
        $per_page = 50;
        $total_pages = $index_set->count()/$per_page;

        $config = [
            'model' => class_basename(Doctor::class)."-".$this->city->alias,
            'fields'=> [
                'name',
                'firstname',
                'lastname',
                'patronymic',
                'skills'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'illnesses'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'qualifications'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'medcenters'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'additional'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[]
                ],
                'city'=>[
                    'value'=>'name',
                    'autocomplete'=>true,
                    'dictionary'=>[
                        'Алматы'=>[
                            'Алма-Ата',
                            'Алмата'
                        ]
                    ]
                ],
            ]
        ];

        Redis::publish('search indexing pages',$total_pages);
        Redis::publish('search indexing',$index_set->count());

        for($page=0; $page<=$total_pages; $page++){

            $data = $index_set->skip($per_page*$page)->take($per_page)->get();
            \App\Jobs\SearchIndexJob::dispatch($config,$data);
        }

    }
}
