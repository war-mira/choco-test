<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.03.2018
 * Time: 5:35
 */

namespace App\Http\Interfaces;


use Illuminate\Http\Request;

interface ITableController
{
    public function tableView(Request $request);
    public function tableData(Request $request);
}