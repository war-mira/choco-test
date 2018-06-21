<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.11.2017
 * Time: 18:32
 */

namespace App\Http\Controllers\Admin;


use App\Callback;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardNotificationController
{
    public function getNotifications(Request $request)
    {
        $from = Carbon::yesterday()->hour(19);
        $to = Carbon::today()->hour(19);
        $callbacks = Callback::whereBetween('created_at', [$from, $to])
            ->where('status', 0)
            ->get();
        $orders = Order::whereBetween('created_at', [$from->timestamp, $to->timestamp])
            ->where('status', 0)
            ->get();
        $notifications = [];
        foreach ($callbacks as $callback) {
            $notifications[] = [
                'title' => '<strong>Обратный вызов</strong>&nbsp;&nbsp;' . $callback->client_name . '(' . $callback->client_phone . ')',
                'url' => route('admin.callbacks.form', ['id' => $callback->id])
            ];
        }
        foreach ($orders as $order) {
            $notifications[] = [
                'title' => '<strong>Заявка</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $order['client_info']['name'] . '(' . $order['client_info']['phone'] . ')',
                'url' => route('admin.orders.form', ['id' => $order->id])
            ];
        }


        return response()->json([
            'count' => count($notifications),
            'html' => view('admin.dashboard.notification-list', compact('notifications'))->render()
        ]);
    }

    public function openNotification($id)
    {
        $notification = DashboardNotification::find($id);
        $notification->status = 1;
        $notification->save();

        return response()->redirectTo($notification->url);
    }
}