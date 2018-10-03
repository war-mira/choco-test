<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Models\Library\IllnessesGroup;
use Illuminate\Http\Request;

class IllnessesGroupController extends Controller
{
    const DEFAULT_FIELDS = [];
    const SEARCH_FIELDS = [
        'name',
        'description'
    ];
    public function getTableView(Request $request)
    {
        $tableName = 'Группы заболеваний';
        $url = route('admin.illnesses-groups.crud.get');
        $form = route('admin.illnesses-groups.form');
        return view('admin.model.illnesses-groups.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = IllnessesGroup::find($id);

        $action = route('admin.illnesses-groups.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.illnesses-groups.form']);
        return view('admin.model.illnesses-groups.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = IllnessesGroup::find($id);
        } else {
            $illnessesGroups = IllnessesGroup::query();
            $result = BootstrapTableHelper::processTableRequest($request, $illnessesGroups, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illnessesGroup = IllnessesGroup::create($data);

        $this->postProcessIllnessesGroup($illnessesGroup);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $illnessesGroup->id]));
        } else
            $response = $illnessesGroup;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illnessesGroup = IllnessesGroup::find($id);

        $illnessesGroup->fill($data);
        $illnessesGroup->save();

        $this->postProcessIllnessesGroup($illnessesGroup);

            if ($redirectRoute != null) {
                $response = redirect(route($redirectRoute, ['id' => $illnessesGroup->id]));
            }else
                $response = $illnessesGroup;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        IllnessesGroup::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();
        $data['alias'] = \Slug::make($data['name']);

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }

    private function postProcessIllnessesGroup($illnessesGroup)
    {
        $titleTrans = \Slug::make($illnessesGroup->name);
        $words = preg_split("/[^A-Za-z0-9]/", $titleTrans);
        $index = 0;
        $alias = $illnessesGroup->id;
        while (strlen($alias) < 50 && count($words) > $index) {
            if (strlen($words[$index]) > 0)
                $alias .= "-" . $words[$index];
            $index++;
        }
        $illnessesGroup->alias = $alias;
        $illnessesGroup->save();
    }

}
