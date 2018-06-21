<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorDoctorColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('patronymic')->nullable();
            $table->integer('child_min_age')->nullable();
            $table->integer('ambulatory_city_price')->nullable();
            $table->integer('ambulatory_country_price')->nullable();
            $table->integer('price_repeat')->nullable();
            $table->text('treatment_text')->nulalble();
            $table->text('grad_text')->nulalble();
            $table->text('exp_text')->nulalble();
            $table->text('community_text')->nulalble();
            $table->text('certs_text')->nulalble();
            $table->text('farm_partners')->nulalble();
            $table->string('personal_site')->nullable();
            $table->boolean('want_web');
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
            $table->string('email')->nullable();
        });
    }
}
