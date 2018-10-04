<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\IFormController;
use App\Http\Interfaces\ITableController;
use App\Http\Resources\Admin\MedicalService\MedicalServiceTable;
use App\MedicalService;
use Illuminate\Http\Request;

class MedicalServiceController extends Controller implements ITableController, IFormController
{
    public function viewForm($id = null, Request $request)
    {
        $service = MedicalService::findOrNew($id);

        return view('admin.medical-services.form', compact('service'));
    }

    public function saveForm($id = null, Request $request)
    {
        $service = MedicalService::findOrNew($id);

        $data = $request->all();
        $data['parent_id'] = $data['parent_id'] ?? null;

        $service->fill($data);
        $service->save();

        return redirect()->route('admin.medical-services.form.view', ['id' => $service->id]);
    }

    public function tableView(Request $request)
    {
        $tableName = 'Услуги';
        $url = route('admin.medical-services.table.data');
        $form = route('admin.medical-services.form.view');

        return view('admin.medical-services.table', compact('tableName', 'url', 'form'));
    }

    public function tableData(Request $request)
    {
        $query = MedicalService::query();
        $resource = new MedicalServiceTable($query);
        return $resource;
    }
}
