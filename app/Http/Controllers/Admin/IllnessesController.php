<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Models\Library\Illness;
use App\Models\Library\IllnessesGroup;
use Illuminate\Http\Request;

class IllnessesController extends Controller
{
    const DEFAULT_FIELDS = [];
    const SEARCH_FIELDS = [
        'name',
        'description'
    ];
    public function getTableView(Request $request)
    {
        $tableName = 'Заболевания';
        $url = route('admin.illnesses.crud.get');
        $form = route('admin.illnesses.form');

        return view('admin.model.illnesses.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Illness::find($id);
        $action = route('admin.illnesses.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.illnesses.form']);

        return view('admin.model.illnesses.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Illness::find($id);
        } else {
            $illnesses = Illness::query();
            $result = BootstrapTableHelper::processTableRequest($request, $illnesses, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illness = Illness::create($data);

        $this->postProcessIllnessesGroup($illness);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $illness->id]));
        } else
            $response = $illness;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illness = Illness::find($id);

        $illness->fill($data);
        $illness->save();

        $this->postProcessIllnessesGroup($illness);

            if ($redirectRoute != null) {
                $response = redirect(route($redirectRoute, ['id' => $illness->id]));
            }else
                $response = $illness;

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

    private function postProcessIllnessesGroup($illnesses)
    {
        $titleTrans = \Slug::make($illnesses->name);
        $words = preg_split("/[^A-Za-z0-9]/", $titleTrans);
        $index = 0;
        $alias = $illnesses->id;
        while (strlen($alias) < 50 && count($words) > $index) {
            if (strlen($words[$index]) > 0)
                $alias .= "-" . $words[$index];
            $index++;
        }
        $illnesses->alias = $alias;
        $illnesses->save();
    }

}
