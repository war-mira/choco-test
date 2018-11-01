<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Medcenter;
use App\MedcenterType;
use Illuminate\Http\Request;

class MedcenterTypeController extends Controller
{

    const SEARCH_FIELDS = ['name'];

    public function getTableView(Request $request)
    {
        $tableName = 'Типы медцентров';
        $url = route('admin.medcenter_types.crud.get');
        $form = route('admin.medcenter_types.form');

        return view('admin.model.medcenter_types.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = MedcenterType::find($id);
        $params = ['redirect' => 'admin.medcenter_types.form'];
        if ($id != null)
            $params['id'] = $id;
        $action = route('admin.medcenter_types.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('admin.model.medcenter_types.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = MedcenterType::find($id);
        } else {
            $medcenter_types = MedcenterType::query();
            $result = BootstrapTableHelper::processTableRequest($request, $medcenter_types, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $medcenter_type = MedcenterType::create($data);
        $medcenter_type->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $medcenter_type->id]));
        } else
            $response = $medcenter_type;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $medcenter_type = MedcenterType::find($id);
        $medcenter_type->update($data);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $medcenter_type->id]));
        } else
            $response = $medcenter_type;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        MedcenterType::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }


    private function processRequestData(Request $request)
    {
        $data = $request->all();

        return $data;
    }

}
