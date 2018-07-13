<?php

namespace App\Http\Controllers;

use App\City;
use App\Helpers\SessionContext;
use Illuminate\Http\Request;
use Session;

class BaseController extends Controller
{
    public function setcity(Request $request, $cytyid)
    {
        $referer = $request->headers->get('referer');
        $city_aliases = [
            "almaty",
            "astana",
        ];

        $occurrence = false;
        foreach($city_aliases as $city_alias){
            if(stristr($referer, $city_alias) !== false){
                $occurrence = true;
                break;
            }
        }

        $city_alias = $cytyid == 7 ? "astana" : "almaty";

        if($occurrence){
            if ($cytyid == 7) {
                $url_to = str_replace('almaty', 'astana', $referer);
            } else {
                $url_to = str_replace('astana', 'almaty', $referer);
            }
        }else{
            $url_to = str_replace(["/doctors", "/medcenters"], ["/{$city_alias}/doctors", "/{$city_alias}/medcenters"], $referer);
        }


        if (City::query()->find($cytyid) != null) {
            $request->session()->put('cityid', $cytyid);
        } else {
            $request->session()->put('cityid', 6);
        }

        $request->session()->save();

        if($request->ajax())
            return 'success';
        return \Redirect::to($url_to, 302);
    }

    public function create_md5(Request $request)
    {
        $input_string = $request->input('input_string');
        return ['md5' => md5($input_string)];
    }
}
