<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersRenameClientColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_appointments', function (Blueprint $table) {
            $table->renameColumn('client', 'client_name');
        });
        Schema::table('tbl_appointments', function (Blueprint $table) {
            $table->unsignedInteger('client_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_appointments', function (Blueprint $table) {
            $table->renameColumn('client_name', 'client');
        });

        Schema::table('tbl_appointments', function (Blueprint $table) {
            $table->dropColumn(['client_id']);
        });
    }
}
