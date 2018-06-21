<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.01.2018
 * Time: 15:57
 */

namespace App\Services;


use App\Order;
use App\User;
use Illuminate\Support\Carbon;

class AdminService
{
    public function ordersStatistics($begin = null, $end = null)
    {
        $begin = $begin ?? Carbon::yesterday()->subDays(40)->setTime(19, 0);
        $end = $end ?? Carbon::today()->setTime(19, 0);

        $orders = Order::query()->whereBetween('created_at', [$begin, $end])->get();
        $phoneOrders = $orders->where('from_internet', 0);
        $internetOrders = $orders->where('from_internet', 1);
        $statistics = [];
        foreach (User::getOperators() as $operator) {
            $operatorOrders = $orders->where('operator_id', $operator->id);
            $operatorPhoneOrders = $operatorOrders->where('from_internet', 0);
            $operatorInternetOrders = $operatorOrders->where('from_internet', 1);
            $statistics[] = [
                'name' => $operator->name,
                'total' => [
                    'count' => $operatorOrders->count(),
                    'statuses' => $this->ordersByStatus($operatorOrders),
                ],
                'phone' => [
                    'count' => $operatorPhoneOrders->count(),
                    'statuses' => $this->ordersByStatus($operatorPhoneOrders),
                ],
                'internet' => [
                    'count' => $operatorInternetOrders->count(),
                    'statuses' => $this->ordersByStatus($operatorInternetOrders),
                ],
            ];
        }
        $statistics[] = [
            'name' => "Всего",
            'total' => [
                'count' => $orders->count(),
                'statuses' => $this->ordersByStatus($orders),
            ],
            'phone' => [
                'count' => $phoneOrders->count(),
                'statuses' => $this->ordersByStatus($phoneOrders),
            ],
            'internet' => [
                'count' => $internetOrders->count(),
                'statuses' => $this->ordersByStatus($internetOrders),
            ],
        ];
        return view('export.operators', compact('statistics'));
    }

    private function ordersByStatus($orders)
    {
        $statusStatistics = [];
        $statuses = [];
        foreach (Order::STATUS as $key => $status) {
            $statuses[$key]['name'] = $status['name'];
            if (isset($status['children']))
                $statuses[$key]['ids'] = array_merge(array_pluck($status['children'], 'id'), [$status['id']]);
            else
                $statuses[$key]['ids'] = [$status['id']];
        }
        $statuses = array_prepend($statuses, ['name' => 'Запись', 'ids' => [1, 2, 3]]);
        foreach ($statuses as $status) {
            $statusStatistics[] = [
                'name' => $status['name'],
                'count' => $orders->whereIn('status', $status['ids'])->count()
            ];
        }
        return $statusStatistics;
    }
}