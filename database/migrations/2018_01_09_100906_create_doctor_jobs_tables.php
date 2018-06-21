<?php

use App\Doctor;
use App\DoctorJob;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorJobsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id');
            $table->integer('medcenter_id');
            $table->integer('status');
            $table->timestamps();
        });

        $doctors = Doctor::get()->map(function ($doctor) {
            return ['doctor_id' => $doctor->id, 'medcenter_id' => $doctor->med_id];
        })->toArray();
        DoctorJob::query()->insert($doctors);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_jobs');
    }
}
