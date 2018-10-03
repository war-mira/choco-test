<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('target_type', 20);
            $table->unsignedInteger('target_id')->nullable();
            $table->string('title', 100);
            $table->string('url', 50)->nullable();
            $table->unsignedInteger('status')->default(0);
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
        Schema::drop('dashboard notifications');
    }
}
