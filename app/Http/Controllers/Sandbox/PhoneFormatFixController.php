<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.02.2018
 * Time: 15:31
 */

namespace App\Http\Controllers\Sandbox;


use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;

class PhoneFormatFixController extends Controller
{
    const PHONES = [
        'comments'          => 'user_email',
        'callbacks'         => 'client_phone'
    ];

    public function fixPhones()
    {
        foreach (self::PHONES as $table => $column) {
            $this->fixColumnPhones($table, $column);
        }
    }

    private function fixColumnPhones($table, $column)
    {

        $records = \DB::table($table)->select(['id', $column])->get()->each(function ($record) use ($column, $table) {
            $id = $record->id;
            $phone = FormatHelper::phone($record->$column);
            \DB::table($table)->where('id', $id)->update([$column => $phone]);
        });
    }

}