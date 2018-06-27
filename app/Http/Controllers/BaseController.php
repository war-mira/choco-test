<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Session;

class BaseController extends Controller
{
    public function setcity(Request $request, $cytyid)
    {
        if ($cytyid == 7) {
            $url_to = str_replace('almaty', 'astana', $request->headers->get('referer'));
        } else {
            $url_to = str_replace('astana', 'almaty', $request->headers->get('referer'));
        }

        if (City::query()->find($cytyid) != null) {
            $request->session()->put('cityid', $cytyid);
        } else {
            $request->session()->put('cityid', 6);
        }

        $request->session()->save();
        return \Redirect::to($url_to, 302);
    }

    public function create_md5(Request $request)
    {
        $input_string = $request->input('input_string');
        return ['md5' => md5($input_string)];
    }
}
