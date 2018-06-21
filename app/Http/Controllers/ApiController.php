<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Medcenter;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function new_order($phone, $operator_id)
    {
        $Doctors = Doctor::where('status', 1)->orderBy('lastname')->get();
        $Medcenters = Medcenter::whereStatus(1)->orderBy('name')->get(['id', 'name']);
          return view('api.orders.create')
                  ->with('token', '345168965432865')
                  ->with('phone', $phone)
                  ->with('Doctors', $Doctors)
                  ->with('Medcenters', $Medcenters)
                  ->with('operator_id', $operator_id);


    }
    public function save_order(Request $request)
    {
          $input = $request->all();
          $current_time = Carbon::now()->timestamp;
        $OrderItem = new Order;
          $OrderItem->client=$input['client'];
          $OrderItem->phone=$input['phone'];
          $OrderItem->email=$input['email'];
          $OrderItem->doc_id=$input['doc_id'];
          $OrderItem->med_id=$input['med_id'];
          $OrderItem->status=$input['status'];
          $OrderItem->problem=$input['problem'];
          $OrderItem->action=$input['action'];
          $OrderItem->date_event=$input['date_event'];
        $OrderItem->date_event2 = $input['date_event2'];
          $OrderItem->date_create=$current_time;
          $OrderItem->date_update=$current_time;
          $OrderItem->send_notify=$input['send_notify'];
          $OrderItem->operator=$input['operator_id'];
          $OrderItem->save();
          return $OrderItem;
    }
}
