<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('callbacks', function (Blueprint $table) {
            $table->string('source')->default('quick_site');
            $table->integer('target_id')->nullable();
            $table->string('target_type')->nullable();
            $table->string('client_comment')->nullable();
            $table->renameColumn('answer', 'operator_comment');
            $table->renameColumn('client', 'client_name');
            $table->renameColumn('phone', 'client_phone');
            $table->renameColumn('date_event', 'event_date');
            $table->integer('operator_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('callbacks', function (Blueprint $table) {
            $table->dropColumn(['source', 'target_id', 'target_type', 'client_comment', 'operator_id']);
            $table->renameColumn('operator_comment', 'answer');
            $table->renameColumn('client_name', 'client');
            $table->renameColumn('client_phone', 'phone');
            $table->renameColumn('event_date', 'date_event');
        });
    }
}
