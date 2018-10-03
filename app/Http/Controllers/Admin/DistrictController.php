<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Location\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getTableView(Request $request)
    {
        $tableName = 'Врачи';
        $url = route('admin.doctors.crud.get');
        $form = route('admin.doctors.form');

        return view('admin.model.doctors.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Doctor::with(['skills'])->findOrNew($id);
        $seed->load(['skills' => function ($query) {
            $query->orderBy('pivot_weight', 'desc');
        }]);
        $params = [];
        if ($id != null)
            $params['id'] = $id;


        $action = route('admin.doctors.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('admin.model.doctors.form', compact('seed', 'action'));
    }

    public function get($id)
    {
        return District::findOrFail($id);
    }

    public function save($id = null, Request $request)
    {
        $id = $id ?? $request->input('id', null);
        $district = District::firstOrNew($id);
        $district->fill($request->all());
        $district->save();
        return $district;
    }

    public function delete($id)
    {
        $district = District::findOrFail($id);
        $district->delete();
        return response('', 204);
    }
}
