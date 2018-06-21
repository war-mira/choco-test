<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use App\Image;
use App\Medcenter;

class MedcenterAvatarMigrationController extends Controller
{
    public function migrateAvatars()
    {
        $medcenters = Medcenter::all();
        foreach ($medcenters as $medcenter) {
            $image = ((new Image)->medcenter($medcenter->id))['path'] ?? null;
            $medcenter->avatar = $image;
            $medcenter->save();
        }
    }
}
