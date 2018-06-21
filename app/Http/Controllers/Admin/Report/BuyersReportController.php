<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.02.2018
 * Time: 12:54
 */

namespace App\Http\Controllers\Admin\Report;


use App\Http\Controllers\Controller;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BuyersReportController extends Controller
{
    public function page(Request $request)
    {
        $start = $request->input('start', false);
        $end = $request->input('end', false);
        $start = $start ? Carbon::createFromFormat('m/Y', $start) : Carbon::now();
        $end = $end ? Carbon::createFromFormat('m/Y', $end) : Carbon::now();
        return view('admin.reports.buyers.page', compact('start', 'end'));
    }

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
                'name'       => $order['client_info']['name'],
                'phone'      => $phone,
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
                'name'       => $order['client_info']['name'],
                'phone'      => $phone,
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

    public function report(Request $request)
    {
        $start = $request->input('start', false);
        $end = $request->input('end', false);
        $start = $start ? Carbon::createFromFormat('m/Y', $start) : Carbon::now();
        $end = $end ? Carbon::createFromFormat('m/Y', $end) : Carbon::now();

        $months = $end->diffInMonths($start);

        $endTimeSlide = $start->copy()->startOfMonth();
        $beginTimeSlide = $endTimeSlide->copy()->subMonths(18);

        for ($i = 0; $i < $months + 1; $i++) {
            $overallOldTimeSpan = [
                'end' => $endTimeSlide->copy()
            ];
            $oldTimeSpan = [
                'begin' => $beginTimeSlide->copy(),
                'end'   => $beginTimeSlide->addMonth()->copy()
            ];
            $recentTimeSpan = [
                'begin' => $beginTimeSlide->copy(),
                'end'   => $endTimeSlide->copy()
            ];
            $currentTimeSpan = [
                'begin' => $endTimeSlide->copy(),
                'end'   => $endTimeSlide->addMonth()->copy()
            ];
            $timespans[] = [
                'overall_old' => $overallOldTimeSpan,
                'old'         => $oldTimeSpan,
                'recent'      => $recentTimeSpan,
                'current'     => $currentTimeSpan
            ];
        }


        foreach ($timespans as $timespan) {

            $overallOldOrders = $this->getOrderClientsForTimeSpan($timespan['overall_old']);
            $oldOrders = $this->getOrderClientsForTimeSpan($timespan['old']);
            $latestOrders = $this->getOrderClientsForTimeSpan($timespan['recent']);
            $currentOrders = $this->getOrderClientsForTimeSpan($timespan['current']);

            $numOverallOrders = count($overallOldOrders);
            $numOverallBuyers = count(array_unique($overallOldOrders));
            $numOverallNewBuyers = count(array_unique(array_diff($currentOrders, $overallOldOrders)));

            $numOrders = count($currentOrders);
            $numBuyersBegin = count(array_unique(array_merge($latestOrders, $oldOrders)));

            $newBuyersOrders = array_diff($currentOrders, array_merge($latestOrders, $oldOrders));
            $numNewBuyersOrders = count($newBuyersOrders);
            $numNewBuyers = count(array_unique($newBuyersOrders));

            $numLostBuyers = count(array_unique(array_diff($oldOrders, array_merge($latestOrders, $currentOrders))));
            $oldBuyersOrders = array_intersect($currentOrders, array_merge($latestOrders, $oldOrders));
            $numOldBuyersOrders = count($oldBuyersOrders);


            $ordersReport[] = [
                'date'           => $timespan['current']['begin']->format('m/Y'),
                'total_orders'   => $numOrders,
                'old_b_orders'   => $numOldBuyersOrders,
                'new_b_orders'   => $numNewBuyersOrders,
                'begin_b'        => $numBuyersBegin,
                'new_b'          => $numNewBuyers,
                'lost_b'         => $numLostBuyers,
                'overall_orders' => $numOverallOrders,
                'overall_b'      => $numOverallBuyers,
                'overall_new_b'  => $numOverallNewBuyers
            ];

        }
        return view('sandbox.orders-count-report', ['monthReports' => $ordersReport]);
    }

    private function getOrderClientsForTimeSpan($timespan)
    {
        $clients = [];
        $orders = Order::query()
            ->where('created_at', '<', $timespan['end'])
            ->whereIn('status', [1, 2, 3]);

        if (isset($timespan['begin']))
            $orders = $orders->where('created_at', '>=', $timespan['begin']);

        $orders = $orders->get();
        foreach ($orders as $order) {
            $clients[] = $order['client_info']['phone'];
        };
        return $clients;
    }
}