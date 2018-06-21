<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->dateTime('begin')->nullable();
            $table->dateTime('end')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('one_time')->default(true);
            $table->integer('page_filter')->default(0);
            $table->text('filter_pages');
            $table->mediumText('content');
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
        Schema::dropIfExists('page_notifications');
    }
}
