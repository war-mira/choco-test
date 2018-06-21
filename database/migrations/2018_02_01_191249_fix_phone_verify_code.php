<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPhoneVerifyCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_verifications', function (Blueprint $table) {
            $table->renameColumn('verify_hash', 'verify_code');
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
            $table->renameColumn('verify_code', 'verify_hash');
        });
    }
}
