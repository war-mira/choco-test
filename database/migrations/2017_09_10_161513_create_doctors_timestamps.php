<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('doctors', function (Blueprint $table) {
            $table->timestamps();
        });*/
        /*$doctors = \App\Doctors::all();
        foreach ($doctors as $doctor)
        {
            $created_at = Carbon::createFromTimestampUTC($doctor->created_at_unix);
            $updated_at = Carbon::createFromTimestampUTC($doctor->updated_at_unix);
            $doctor->created_at = $created_at;
            $doctor->updated_at = $updated_at;
            $doctor->save();
        }*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
