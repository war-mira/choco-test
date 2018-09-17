<?php

namespace App\Jobs\Report;

use App\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class DoctorClicksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $doctorsClicksRows = Redis::keys('doctor:*:clicks');

        $dateStart = new \DateTime();
        $dateStart->setTime(0,0);
        $dateEnd = new \DateTime('tomorrow');
        $dateEnd->setTime(0,0);

        foreach ($doctorsClicksRows as $row){
            $set = Redis::ZRANGE($row, 0, -1);

            foreach ($set as $setRow){
                if(Redis::ZSCORE($row, $setRow) > $dateStart && Redis::ZSCORE($row, $setRow) < $dateEnd) {
                    $doctorId = explode(':', $row)[1];
                    $doctor = Doctor::find($doctorId);
                    if ($doctor) {
                        $city = $doctor->city ? $doctor->city->name : 'Не известно';


                        $usersData = Redis::ZRANGE($row, 0, -1);

                        $data = [
                            'doctor' => [
                                'full_name' => $doctor->name,
                                'phone' => $doctor->phone,
                                'city'      => $city,
                                'id'        => $doctorId,
                                'partner'   => $doctor->partner
                            ],
                            'user'   => $usersData
                        ];

                        $dailyCount = $doctor->clicksCount($dateStart, $dateEnd);
                        if ($dailyCount)
                            Redis::zadd('doctor_city_date:' . $doctor->id . ':' . $city . ':' . $dateStart->getTimestamp() . ':daily:clicks', $dailyCount, json_encode($data));

                        $week = $dateStart->modify('-1 week');
                        $weeklyCount = $doctor->clicksCount($week, $dateEnd);

                        if ($weeklyCount)
                            Redis::zadd('doctor_city_date:' . $doctor->id . ':' . $city . ':' . $week->getTimestamp() . ':weekly:clicks', $weeklyCount, json_encode($data));

                        $month = $dateStart->modify('-1 month');
                        $monthlyCount = $doctor->clicksCount($month, $dateEnd);

                        if ($monthlyCount)
                            Redis::zadd('doctor_city_date:' . $doctor->id . ':' . $city . ':' . $month->getTimestamp() . ':monthly:clicks', $monthlyCount, json_encode($data));
                    }
                }
            }
        }
    }
}
