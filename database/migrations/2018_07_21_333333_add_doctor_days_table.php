<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('mond')->nullable();
            $table->string('tues')->nullable();
            $table->string('wedn')->nullable();
            $table->string('thur')->nullable();
            $table->string('frid')->nullable();
            $table->string('satu')->nullable();
            $table->string('sund')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('mond');
            $table->dropColumn('tues');
            $table->dropColumn('wedn');
            $table->dropColumn('thur');
            $table->dropColumn('frid');
            $table->dropColumn('satu');
            $table->dropColumn('sund');
        });
    }
}
