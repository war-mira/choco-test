<?php

namespace App\Helpers;


use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MetricManager
{

    static $prefix = 'metrics:history:';
    static $scales = [
//        'day',
        'week',
        'month',

    ];
    static $metrics = [
//        'feedback_opened',
//        'medcenters_with_feedback',
        'doctors_with_feedback',
//        'doctors_without_phones_with_feedback',
//        'doctor_clicks',
//        'doctors_with_clicks',
//        'doctors_with_clicks_total'
    ];


    public function __construct()
    {

    }

    public function report($from=null,$to=null)
    {
        $report = [];
        foreach (static::$metrics as $metric){
            $scales = [];
            foreach (static::$scales as $scale){
                $scales[$scale] = $this->metric($metric,$scale,$from,$to);
            }
            $report[$metric] = $scales;
        }
        return $report;
    }

    public function metric($metric,$scale='day',$from=null,$to=null)
    {

        $from = $from?Carbon::createFromFormat('Y-n-j',$from):Carbon::now();
        $to = $to?Carbon::createFromFormat('Y-n-j',$to):Carbon::now();

        $periods = CarbonPeriod::create($from,'1 '.$scale,$to);

        $range = [];
        foreach ($periods as $key => $date) {
            if ($key) {
                $range[$date->toDateString()]=
                    $this->{'metric_'.$metric}($date,$scale);
            }
        }

        return $range;
    }

    public function metric_feedback_opened($point, $scale='day')
    {
        return \App\Comment::where(['status'=>1,'owner_type'=>'Doctor'])
            ->whereBetween('created_at',[
                $point->{'startOf'.$scale}()->toDateTimeString(),
                $point->{'endOf'.$scale}()->toDateTimeString()
            ])
            ->count();
    }


    public function metric_doctors_with_feedback($point, $scale='day')
    {
//        dd($point->{'endOf'.$scale}()->toDateTimeString());
        return DB::select("SELECT COUNT(*) as num FROM (SELECT owner_id, count(*) as cnt FROM comments
                where owner_type = 'Doctor'
                and created_at <= '{$point->{'endOf'.$scale}()->toDateTimeString()}'
                group by owner_id
                having cnt>=5) as tmp")[0]->num
            ;
    }

    public function metric_medcenters_with_feedback($point, $scale='day')
    {
//        dd($point->{'endOf'.$scale}()->toDateTimeString());
        return DB::select("SELECT COUNT(*) as num FROM (SELECT owner_id, count(*) as cnt FROM comments
                where owner_type = 'Medcenter'
                and created_at <= '{$point->{'endOf'.$scale}()->toDateTimeString()}'
                group by owner_id
                having cnt>=1) as tmp")[0]->num
            ;
    }

    public function metric_doctors_with_clicks($point, $scale='day')
    {

        $ids = collect(Redis::keys('doctor:*:show-phone'))->transform(function ($key) use ($point, $scale){
            return [
                'id'=>explode(':',$key)[1],
                'count'=> count(Redis::zrangebyscore(
                    $key,
                    $point->{'startOf'.$scale}()->timestamp,
                    $point->{'endOf'.$scale}()->timestamp))
            ];
        })->where('count','>',50)->count();

        return $ids;
    }
    public function metric_doctor_clicks($point, $scale='day')
    {

        $ids = collect(Redis::keys('doctor:*:show-phone'))->transform(function ($key) use ($point, $scale){
            return [
                'id'=>explode(':',$key)[1],
                'count'=> count(Redis::zrangebyscore(
                    $key,
                    $point->{'startOf'.$scale}()->timestamp,
                    $point->{'endOf'.$scale}()->timestamp))
            ];
        })->where('count','>=',1)->sum('count');

        return $ids;
    }



    public function metric_doctors_without_phones_with_feedback($point, $scale='day')
    {
        return DB::select("SELECT COUNT(*) as num FROM (SELECT owner_id, count(*) as cnt FROM comments
                where owner_type = 'Doctor'
                and owner_id in (select id from doctors where show_phone = 0 and status = 1)
                and created_at <= '{$point->{'endOf'.$scale}()->toDateTimeString()}'
                group by owner_id
                having cnt>=1) as tmp")[0]->num;
    }


    public function metric_doctors_with_clicks_total($point, $scale='day')
    {

        $ids = collect(Redis::keys('doctor:*:show-phone'))->transform(function ($key) use ($point, $scale){
            return [
                'id'=>explode(':',$key)[1],
                'key'=>$key,
                'count'=> count(Redis::zrangebyscore(
                    $key,
                    '-inf',
                    $point->{'endOf'.$scale}()->timestamp))
            ];
        })
            ->where('count','>=',1)
            ->where('count','<',10)
            ->count();

        return $ids;
    }
}


/*
% докторов <50 просмотров телефонов
% докторов 10>50 просмотров телефонов
% докторов 1>10 просмотров телефонов
% докторов БЕЗ просмотров телефонов

//Кол-во отзывов
Кол-во врачей
Кол-во клиник
//% врачей с 5 и более отзывами
*/
