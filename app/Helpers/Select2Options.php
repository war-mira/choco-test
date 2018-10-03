<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.03.2018
 * Time: 23:41
 */

namespace App\Helpers;


use App\Models\Doctors\DoctorJob;
use App\Enums\MedicalServiceType;
use App\MedicalService;

class Select2Options
{
    public static function doctorJobs($doctor){
        return DoctorJob::query()
            ->where('doctor_id',$doctor->id)
            ->get()
            ->map(function ($job){
                return ['id'=>$job->id,'text'=>$job->medcenter->name];
            });
    }

    public static function medicalServices(){
        return MedicalService::query()
            ->where('type',MedicalServiceType::SERVICE)
            ->get()
            ->map(function ($mService){
                return ['id'=>$mService->id,'text'=>$mService->name,'category_id'=>$mService->parent_id ?? null];
            });
    }

    public static function medicalServiceCategories(){
        return MedicalService::query()
            ->where('type',MedicalServiceType::CATEGORY)
            ->get()
            ->map(function ($mService){
                return ['id'=>$mService->id,'text'=>$mService->name];
            });
    }
}