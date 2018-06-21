<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Medcenter;
use Illuminate\Http\Request;

class MedcenterController extends Controller
{
    const FILE_FIELDS = ['avatar'];
    const DEFAULT_FIELDS = [
        'ambulatory' => 0
    ];
    const SEARCH_FIELDS = ['name', 'city' => ['name'], 'email'];

    public function getTableView(Request $request)
    {
        $tableName = 'Медцентры';
        $url = route('admin.medcenters.crud.get');
        $form = route('admin.medcenters.form');

        return view('admin.model.medcenters.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Medcenter::find($id);
        $params = ['redirect' => 'admin.medcenters.form'];
        if ($id != null)
            $params['id'] = $id;
        $action = route('admin.medcenters.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('admin.model.medcenters.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Medcenter::find($id);
        } else {
            $medcenters = Medcenter::query()->with(['city']);
            $result = BootstrapTableHelper::processTableRequest($request, $medcenters, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $medcenter = new Medcenter();
        $medcenter->fill($data);
        $medcenter->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $medcenter->id]));
        } else
            $response = $medcenter;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $medcenter = Medcenter::find($id);
        $medcenter->fill($data);
        $medcenter->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $medcenter->id]));
        } else
            $response = $medcenter;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Medcenter::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    public function setstatus(Request $request)
    {
        $medId = $request->input('id');
        $status = $request->input('status', 0);
        $scope = $request->input('scope', 'self');
        $medcenter = Medcenter::find($medId);
        $medcenter->update(['status' => $status]);
        if ($scope == 'all') {
            $medcenter->doctors()->update(['status' => $status]);
        }
        return response('ok');
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();

        foreach (self::FILE_FIELDS as $fileField) {
            if ($request->hasFile($fileField))
                $data[$fileField] = $request->file($fileField)->store('images');
        }

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }

}
