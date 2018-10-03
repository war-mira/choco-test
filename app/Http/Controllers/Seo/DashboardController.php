<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.02.2018
 * Time: 12:52
 */

namespace App\Http\Controllers\Seo;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('seo.dashboard');
    }

}