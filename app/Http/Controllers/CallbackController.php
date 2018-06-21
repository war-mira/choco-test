<?php

namespace App\Http\Controllers;

use App\Callback;
use Request;
use Carbon\Carbon;

class CallbackController extends Controller
{
    public function newQuick()
    {
        $data = Request::all();
        $callback = Callback::create($data);
        return $callback;
    }

    public function newDoc(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $callback = new Callback();
        if(isset($data['client_datetime_2'])){
            $callback->client_datetime = Carbon::createFromFormat("Y-m-d\TH:i", $data['client_datetime_2']);
        }else{
            $callback->client_datetime = Carbon::createFromFormat("Y-m-d H:i", $data['client_datetime']);
        }
        $callback->fill($data);
        $callback->save();

        return $callback;
    }

    public function update()
    {
        $Input = Request::all();
        $Callback = Callback::find($Input['id']);
        $Callback->status = $Input['status'];
        $Callback->answer = $Input['answer'];
        $Callback->operator = $Input['operator'];
        $Callback->save();

        return $Callback;
    }

    public function list()
    {
        $status_array = [
            0 => 'Новый',
            1 => 'В работе',
            2 => 'Отвечен'
        ];
        $Callbacks = Callback::orderBy('id', 'desc')->get();
        return view('admin.callbacks.list')->with('Callbacks', $Callbacks)->with('status_array', $status_array);
    }

    public function item($id)
    {
        $status_array = [
            0 => 'Новый',
            1 => 'В работе',
            2 => 'Отвечен'
        ];
        $Callback = Callback::find($id);
        if ($Callback->status == 0) {
            $Callback->status = 1;
            $Callback->save();
        }
        return view('admin.callbacks.item')->with('Callback', $Callback)->with('status_array', $status_array);
    }
}
