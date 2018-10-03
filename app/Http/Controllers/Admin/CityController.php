<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Interfaces\IFormController;
use App\Http\Interfaces\ITableController;
use App\Http\Resources\Admin\City\CommentTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller implements ITableController, IFormController
{
    public function viewForm($id = null, Request $request)
    {
        $city = City::findOrNew($id);

        return view('admin.cities.form', compact('city'));
    }

    public function saveForm($id = null,Request $request)
    {
        $city = City::findOrNew($id);

        $data = $request->all();

        $city->fill($data);
        $city->save();

        return redirect()->route('admin.cities.form.view',['id'=>$city->id]);
    }

    public function tableView(Request $request)
    {
        $tableName = 'Города';
        $url = route('admin.cities.table.data');
        $form = route('admin.cities.form.view');

        return view('admin.cities.table', compact('tableName', 'url', 'form'));
    }

    public function tableData(Request $request)
    {
        $query = City::query();
        $resource = new CommentTable($query);
        return $resource;
    }
}
