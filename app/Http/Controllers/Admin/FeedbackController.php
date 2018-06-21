<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Model\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    const DEFAULT_FIELDS = [
        'status' => 0,
    ];
    const SEARCH_FIELDS = ['name', 'phone', 'email', 'user' => ['name', 'phone', 'email'], 'text'];

    public function getTableView(Request $request)
    {
        $tableName = 'Врачи';
        $url = route('admin.feedbacks.crud.get');
        $form = route('admin.feedbacks.form');

        return view('admin.model.feedbacks.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Feedback::findOrNew($id);
        $params = [];
        if ($id != null)
            $params['id'] = $id;
        $action = route('admin.feedbacks.save', $params);
        return view('admin.model.feedbacks.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Feedback::with(['user'])->find($id);
        } else {
            $doctors = Feedback::with(['user']);
            $result = BootstrapTableHelper::processTableRequest($request, $doctors, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function save($id = false, Request $request)
    {
        $data = $request->all();
        $feedback = (new Feedback($data));
        $feedback->save();

        return $feedback;
    }

    public function delete(Request $request, $id)
    {
        Feedback::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

}
