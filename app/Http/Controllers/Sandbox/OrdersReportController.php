<?php

namespace App\Http\Controllers\Sandbox;

use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;

class OrdersReportController extends Controller
{

    public function lostClients()
    {
        $beginPeriod = Carbon::create(2016, 7, 1, 0, 0, 0);

        $contacts = [];

        $oldOrders = Order::query()
            ->where('created_at', '<', $beginPeriod)
            ->whereIn('status', [1, 2, 3])
            ->get();


        foreach ($oldOrders as $order) {
            $phone = $order['client_info']['phone'];
            $contacts[$phone] = [
                'name' => $order['client_info']['name'],
                'phone' => $phone,
                'last_order' => $order['created_at']
            ];
            $oldClients[] = $order['client_info']['phone'];
        };

        $currentOrders = Order::query()
            ->where('created_at', '>=', $beginPeriod)
            ->whereIn('status', [1, 2, 3])
            ->get();
        foreach ($currentOrders as $order) {
            $phone = $order['client_info']['phone'];
            $contacts[$phone] = [
                'name' => $order['client_info']['name'],
                'phone' => $phone,
                'last_order' => $order['created_at']
            ];
            $currentClients[] = $order['client_info']['phone'];
        };

        $lostClients = array_unique(array_diff($oldClients, $currentClients));

        $clients = [];
        foreach ($lostClients as $lostClient) {
            $clients[] = $contacts[$lostClient];
        }

        return view('sandbox.orders.clients-list', compact('clients'));

    }
    public function clientsReport()
    {
        $beginTimeSlide = Carbon::create(2015, 8, 1, 0, 0, 0);

        $endTimeSlide = $beginTimeSlide->copy();
        $endTimeSlide->addMonths(17);

        for ($i = 0; $i < 12; $i++) {
            $oldTimeSpan = [
                'begin' => $beginTimeSlide->timestamp,
                'end' => $beginTimeSlide->addMonth()->timestamp
            ];
            $recentTimeSpan = [
                'begin' => $beginTimeSlide->timestamp,
                'end' => $endTimeSlide->timestamp
            ];
            $currentTimeSpan = [
                'begin' => $endTimeSlide->timestamp,
                'end' => $endTimeSlide->addMonth()->timestamp
            ];

            $timespans[] = [
                'old' => $oldTimeSpan,
                'recent' => $recentTimeSpan,
                'current' => $currentTimeSpan
            ];
        }


        foreach ($timespans as $timespan) {

            $oldOrders = $this->getOrderClientsForTimeSpan($timespan['old']);
            $latestOrders = $this->getOrderClientsForTimeSpan($timespan['recent']);
            $currentOrders = $this->getOrderClientsForTimeSpan($timespan['current']);

            $numOrders = count($currentOrders);
            $numBuyersBegin = count(array_unique(array_merge($latestOrders, $oldOrders)));

            $newBuyersOrders = array_diff($currentOrders, array_merge($latestOrders, $oldOrders));
            $numNewBuyersOrders = count($newBuyersOrders);
            $numNewBuyers = count(array_unique($newBuyersOrders));

            $numLostBuyers = count(array_unique(array_diff($oldOrders, array_merge($latestOrders, $currentOrders))));
            $oldBuyersOrders = array_intersect($currentOrders, array_merge($latestOrders, $oldOrders));
            $numOldBuyersOrders = count($oldBuyersOrders);


            $ordersReport[] = [
                'total_orders' => $numOrders,
                'old_b_orders' => $numOldBuyersOrders,
                'new_b_orders' => $numNewBuyersOrders,
                'begin_b' => $numBuyersBegin,
                'new_b' => $numNewBuyers,
                'lost_b' => $numLostBuyers
            ];

        }
        return view('sandbox.orders-count-report', ['monthReports' => $ordersReport]);
    }

    private function getOrderClientsForTimeSpan($timespan)
    {
        $clients = [];
        $orders = Order::query()
            ->where('date_create', '>=', $timespan['begin'])
            ->where('date_create', '<', $timespan['end'])
            ->whereIn('status', [1, 2, 3])
            ->get();
        foreach ($orders as $order) {
            $clients[] = $order['client_info']['phone'];
        };
        return $clients;
    }
}
