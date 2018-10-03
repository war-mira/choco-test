<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPhoneVerifyTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_verifications', function (Blueprint $table) {
            $table->renameColumn('expire_timstamp', 'expire_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_verifications', function (Blueprint $table) {
            $table->renameColumn('expire_timestampph', 'expire_timstamp');
        });
    }
}
