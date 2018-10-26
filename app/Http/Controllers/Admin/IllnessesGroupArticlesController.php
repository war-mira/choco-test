<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Models\Library\IllnessesGroupArticle;
use Illuminate\Http\Request;

class IllnessesGroupArticlesController extends Controller
{
    const FILE_FIELDS = ['image'];
    const DEFAULT_FIELDS = [];
    const SEARCH_FIELDS = [
        'name',
        'description'
    ];
    public function getTableView(Request $request)
    {
        $tableName = 'Статьи';
        $url = route('admin.illnesses-articles.crud.get');
        $form = route('admin.illnesses-articles.form');

        return view('admin.model.illnesses-group-articles.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = IllnessesGroupArticle::find($id);
        $action = route('admin.illnesses-articles.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.illnesses-articles.form']);

        return view('admin.model.illnesses-group-articles.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = IllnessesGroupArticle::find($id);
        } else {
            $illnessesArticles = IllnessesGroupArticle::query();
            $result = BootstrapTableHelper::processTableRequest($request, $illnessesArticles, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illnessesArticle = IllnessesGroupArticle::create($data);

        $this->postProcessIllnessesGroup($illnessesArticle);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $illnessesArticle->id]));
        } else
            $response = $illnessesArticle;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $illnessesArticle = IllnessesGroupArticle::find($id);

        $illnessesArticle->fill($data);
        $illnessesArticle->save();

        //$this->postProcessIllnessesGroup($illnessesArticle);

            if ($redirectRoute != null) {
                $response = redirect(route($redirectRoute, ['id' => $illnessesArticle->id]));
            }else
                $response = $illnessesArticle;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        IllnessesGroupArticle::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();
        $data['alias'] = \Slug::make($data['name']);
        foreach (self::FILE_FIELDS as $fileField) {
            if ($request->hasFile($fileField))
                $data[$fileField] = $request->file($fileField)->store('uploads/illnesses');
            else
                unset($data[$fileField]);
        }
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
