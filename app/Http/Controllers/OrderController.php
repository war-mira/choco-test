<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function feedbackView($token)
    {
        $order = Order::query()->firstOrFail(['feedback_token' => $token]);
        return view('order.feedback', compact('order'));
    }

    public function feedbackLeave($token, Request $request)
    {
        $order = Order::query()->firstOrFail(['feedback_token' => $token]);

    }
}
