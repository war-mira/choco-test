<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOldTables extends Migration
{
    const TABLES = ['tbl_answers',
        'tbl_category',
        'tbl_category_new',
        'tbl_doctor_illness',
        'tbl_drugs',
        'tbl_event',
        'tbl_illness',
        'tbl_images',
        'tbl_medcenter_categories',
        'tbl_menu',
        'tbl_order',
        'tbl_post_category',
        'tbl_profiles',
        'tbl_profiles_fields',
        'tbl_promo',
        'tbl_promo_order',
        'tbl_questions',
        'tbl_questions_categories',
        'tbl_settings',
        'tbl_skill_illness',
        'tbl_slider',
        'tbl_summary_med_user',
        'tbl_summary_user',
        'tbl_team',
        'tbl_users',
        'Rights',
        'cab_users',
        'cab_password_resets',
        'AuthItemChild',
        'AuthItem',
        'AuthAssignment'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach (self::TABLES as $table) {
            $oldname = $table;
            $newname = '_old_' . $table;
            Schema::table($oldname, function (Blueprint $table) use ($newname) {
                $table->rename($newname);
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (self::TABLES as $table) {
            $newname = $table;
            $oldname = '_old_' . $table;
            Schema::table($oldname, function (Blueprint $table) use ($newname) {
                $table->rename($newname);
            });
        }
    }
}
