<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $todayOrders = Order::where('status', OrderStatus::VISIT_CHECK)
            ->whereBetween('event_date', [today(), today()->addDay()])->get();
        $yesterdayOrders = Order::where('status', OrderStatus::VISIT_CHECK)
            ->whereBetween('event_date', [today()->subDay(), today()])->get();
        $tomorrowOrders = Order::where('status', OrderStatus::VISIT_CHECK)
            ->whereBetween('event_date', [today()->addDay(), today()->addDays(2)])->get();
        return view('admin.dashboard')->with(compact('todayOrders', 'yesterdayOrders', 'tomorrowOrders'));
    }

}
