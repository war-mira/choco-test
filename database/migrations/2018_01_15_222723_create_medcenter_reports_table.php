<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedcenterReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medcenter_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medcenter_id');
            $table->unsignedInteger('report_group_id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->integer('status')->default(0);
            $table->string('download_url')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->integer('total')->nullable();
            $table->dateTime('formed_at')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medcenter_reports');
    }
}
