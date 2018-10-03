<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.12.2017
 * Time: 15:18
 */

namespace App\Http\Controllers\Sandbox;


use App\Facades\SmsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsServiceTestController extends Controller
{
    public function testSend(Request $request)
    {
        $id = $request->input('id');
        $phone = $request->input('recipient');
        $text = $request->input('text');

        $message = compact('id', 'recipient', 'text');
        $status = SmsService::send($message);
        return compact('status');
    }
}