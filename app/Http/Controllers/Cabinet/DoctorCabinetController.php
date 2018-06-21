<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.11.2017
 * Time: 15:45
 */

namespace App\Http\Controllers\Cabinet;


use App\Doctor;
use App\Order;
use Illuminate\Http\Request;

class DoctorCabinetController
{
    public function index(Request $request)
    {
        $doctor = Doctor::where('account_id', \Auth::user()->id)->first();
        $orders = $doctor->orders()->orderBy('id', 'desc')->take(20)->get();
        return view('cabinet.doctor.index', compact('doctor', 'orders'));
    }

    public function orderList(Request $request)
    {
        $doctor = Doctor::where('account_id', \Auth::user()->id)->first();
        $orders = $doctor->orders()->orderBy('id', 'desc');
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            foreach ($filter as $filterStmt) {
                $column = $filterStmt[0];
                $method = $filterStmt[1];
                $val = $filterStmt[2];

                switch ($method) {
                    case 'between':
                        $orders = $orders->whereBetween($column, $val);
                        break;
                    case 'in':
                        $orders = $orders->whereIn($column, $val);
                        break;
                    case 'not in':
                        $orders = $orders->whereNotIn($column, $val);
                        break;
                    default:
                        $orders = $orders->where($column, $method, $val);
                        break;
                }
            }
        }
        $orders = $orders->get();
        return view('cabinet.components.order.list', compact('orders'));

    }

    public function orderDetails(Request $request, $id)
    {
        $order = Order::find($id);
        return view('cabinet.components.order.details', compact('order'));
    }

}