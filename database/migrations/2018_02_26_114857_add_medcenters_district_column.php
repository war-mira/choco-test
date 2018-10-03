<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedcentersDistrictColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medcenters', function (Blueprint $table) {
            $table->unsignedInteger('district_id')->nullalble();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medcenters', function (Blueprint $table) {
            $table->dropIfExists('district_id');
        });
    }
}
