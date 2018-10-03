<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStatusToStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('is_public', 'status');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('is_public', 'status');
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->renameColumn('is_public', 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('status', 'is_public');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->renameColumn('status', 'is_public');
        });
        Schema::table('medcenters', function (Blueprint $table) {
            $table->renameColumn('status', 'is_public');
        });
    }
}
