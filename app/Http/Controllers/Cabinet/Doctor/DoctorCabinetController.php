<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.11.2017
 * Time: 15:45
 */

namespace App\Http\Controllers\Cabinet\Doctor;


use App\Doctor;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class DoctorCabinetController extends Controller
{
    protected $user;
    protected $doctor;

    function __construct() {

        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            $this->doctor = Doctor::where('user_id', \Auth::user()->id)->first();

            return $next($request);
        });

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