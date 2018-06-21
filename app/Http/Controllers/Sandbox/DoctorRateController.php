<?php

namespace App\Http\Controllers\Sandbox;

use App\Doctor;
use App\Http\Controllers\Controller;

class DoctorRateController extends Controller
{
    public function recalcRate()
    {
        $doctors = Doctor::all();
        $doctors->each(function ($doctor) {
            /** @var Doctor $doctor */
            $doctor->updateCommentRate();
        });
    }
}
