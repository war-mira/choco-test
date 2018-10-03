<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    const DEFAULT_FIELDS = [
        'top_doctors' => [],
        'position' => 0,
        'category' => 0
    ];
    const SEARCH_FIELDS = [
        'name',
        'alias',
        'description'
    ];

    public function getTableView(Request $request)
    {
        $tableName = 'Специализации';
        $url = route('admin.skills.crud.get');
        $form = route('admin.skills.form');
        return view('admin.model.skills.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Skill::find($id);
        $action = route('admin.skills.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.skills.form']);
        return view('admin.model.skills.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Skill::find($id);
        } else {
            $skills = Skill::query();
            $result = BootstrapTableHelper::processTableRequest($request, $skills, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $skill = Skill::create($data);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $skill->id]));
        } else
            $response = $skill;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $skill = Skill::find($id);
        $skill->fill($data);
        $skill->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $skill->id]));
        } else
            $response = $skill;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Skill::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }
}
