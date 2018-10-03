<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderOperatorRename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_appointments', function (Blueprint $table) {
            $table->renameColumn('operator', 'operator_name');
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
            $table->renameColumn('operator_name', 'operator');
        });
    }

}
