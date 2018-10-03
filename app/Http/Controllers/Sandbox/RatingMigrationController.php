<?php

namespace App\Http\Controllers\Sandbox;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Medcenter;

class RatingMigrationController extends Controller
{
    public function migrateRating()
    {
        Doctor::all()->each(function (Doctor $doctor) {
            $doctor->updateCommentRate();
        });

        Medcenter::all()->each(function (Medcenter $medcenter) {
            $medcenter->updateCommentRate();
        });
    }
}
