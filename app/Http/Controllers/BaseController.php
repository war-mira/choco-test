<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Session;

class BaseController extends Controller
{
    public function setcity($cytyid)
    {
        if (City::query()->find($cytyid) != null)
            Session::put('cityid', $cytyid);
        else
            Session::put('cityid', 6);
        return \Redirect::to('/', 302);
    }

    public function create_md5(Request $request)
    {
        $input_string = $request->input('input_string');
        return ['md5'=>md5($input_string)];
    }
}
