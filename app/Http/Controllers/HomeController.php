<?php

namespace App\Http\Controllers;

use App\City;
use App\Order;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::check())
      {
          $Orders = new Order;

          $City = City::select('id', 'name')->where('parent_id', 1)->where('status', 1)->get();
          return view('home')->with('title');
      }
    }

    
}
