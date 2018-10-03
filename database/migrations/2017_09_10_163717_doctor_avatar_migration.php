<?php

use App\Image;
use Illuminate\Database\Migrations\Migration;

class DoctorAvatarMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $doctors = \App\Doctor::all();
        $DoctorImages = new Image;
        foreach ($doctors as $doctor)
        {
            $Image = $DoctorImages->doctor($doctor->id);
            $ImageFileName = $Image['path'];
            if(empty($ImageFileName)){
                $ImageFileName='images/no-userpic.gif';
            }
            $doctor->avatar = $ImageFileName;
            $doctor->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
