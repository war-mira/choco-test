<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.03.2018
 * Time: 22:32
 */

namespace App\Http\Interfaces;


use Illuminate\Http\Request;

interface IFormController
{
    public function viewForm($id, Request $request);

    public function saveForm($id, Request $request);
}