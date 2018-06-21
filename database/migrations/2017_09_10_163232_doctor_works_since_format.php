<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoctorWorksSinceFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('works_since','works_since_unix');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->date('works_since')->nullable();
        });
        $doctors = \App\Doctor::all();
        foreach ($doctors as $doctor)
        {
            $works_since = Carbon::createFromTimestampUTC($doctor->works_since_unix);
            $doctor->works_since = $works_since;
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
        Schema::table('doctors', function (Blueprint $table) {
            $table->removeColumn('works_since');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('works_since_unix','works_since');
        });
    }
}
