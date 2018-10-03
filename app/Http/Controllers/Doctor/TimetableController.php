<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctors\Doctor;
use App\Http\Controllers\Controller;
use App\JobTime;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public static function getDoctorTimetable(Doctor $doctor, Request $request)
    {
        $jobTimetables = JobTime::query()->whereHas('job', function ($jobQuery) use ($doctor) {
            $jobQuery->where('doctor_id', $doctor->id);
        })->get();
        return $jobTimetables;
    }
}
