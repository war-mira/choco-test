<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersMigrationController extends Controller
{
    public function migrateTimestamps(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');

        $orders = Order::query()->offset($offset)->limit($limit)->get();
        foreach ($orders as $order) {
            $createdAt = Carbon::createFromTimestamp($order->date_create)->format('Y-m-d H:i:s');
            $updatedAt = Carbon::createFromTimestamp($order->date_update)->format('Y-m-d H:i:s');
            $eventDate = Carbon::createFromTimestamp($order->date_event)->format('Y-m-d H:i:s');
            $event2Date = Carbon::createFromTimestamp($order->date_event2)->format('Y-m-d H:i:s');

            $min = '2010-01-01 00:00:00';
            $max = '2019-01-01 00:00:00';

            $now = now()->format('Y-m-d H:i:s');

            $createdAt = $this->valIfOutOfRange($createdAt, $min, $max, $now);
            $updatedAt = $this->valIfOutOfRange($updatedAt, $min, $max, $createdAt);
            $eventDate = $this->valIfOutOfRange($eventDate, $min, $max, null);
            $event2Date = $this->valIfOutOfRange($event2Date, $min, $max, null);

            $order->created_at = $createdAt;
            $order->updated_at = $updatedAt;
            $order->event_date = $eventDate;
            $order->event2_date = $event2Date;
            $order->save();
        }
    }

    private function valIfOutOfRange($date, $min, $max, $val)
    {
        if ($date < $min || $date > $max)
            $date = $val;
        return $date;
    }

    public function formatPhone(Request $request)
    {

    }
}
