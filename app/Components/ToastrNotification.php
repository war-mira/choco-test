<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.09.2018
 * Time: 16:50
 */

namespace App\Components;


class ToastrNotification
{
    public static function push($msg,$type = 'warning')
    {
        session()->push('toast_messages',[
            'type'=>$type,
            'msg' => $msg
        ]);
    }

    public static function get($json = true){
        $messages = session('toast_messages');
        session()->forget('toast_messages');
        return $json?json_encode($messages):$messages;
    }
}