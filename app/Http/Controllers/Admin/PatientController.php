<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SearchHelper;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\IFormController;
use App\Http\Interfaces\ITableController;
use App\Http\Resources\Admin\Patient\PatientFormResource;
use App\Http\Resources\Admin\Patient\PatientTable;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller implements IFormController, ITableController
{
    public function viewForm($id = null, Request $request)
    {
        $patient = Patient::findOrNew($id);
        return view('admin.patients.form', compact('patient'));
    }

    public function saveForm($id = null, Request $request)
    {
        $id = $id ?? $request->input('id',null);
        $patient = Patient::findOrNew($id);
        $data = $request->all();
        $patient->fill($data);
        $patient->save();


        return redirect()->route('admin.patients.form.view', ['id' => $patient->id]);
    }

    public function tableView(Request $request)
    {
        $tableName = 'Посты';
        $url = route('admin.patients.table.data');
        $form = route('admin.patients.form.view');

        return view('admin.patients.table', compact('tableName', 'url', 'form'));
    }

    public function tableData(Request $request)
    {
        $query = Patient::query();
        $resource = new PatientTable($query);
        return $resource;
    }


    public function get($id = null, Request $request)
    {
        $id = $id ?? $request->input('id',null);
        $patient = Patient::findOrFail($id);
        return new PatientFormResource($patient);
    }

    public function save($id = null, Request $request)
    {
        $id = $id ?? $request->input('id',null);
        $patient = Patient::findOrNew($id);
        $data = $request->all();
        $patient->fill($data);
        $patient->save();
        return new PatientFormResource($patient);
    }

    public function search(Request $request)
    {
        $patients = Patient::query();
        $patients = SearchHelper::searchByFields($patients, ['id',
                                                             'firstname',
                                                             'lastname',
                                                             'middlename',
                                                             'birthday',
                                                             'phone',
                                                             'phone2'], $request->input('q'))->get();
        return $patients;
    }
}
