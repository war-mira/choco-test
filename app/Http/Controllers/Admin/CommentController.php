<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    const DEFAULT_FIELDS = [
        'status' => 0
    ];
    const SEARCH_FIELDS = [
        'text',
        'user_name',
        'user_email'
    ];

    public function getTableView(Request $request)
    {
        $tableName = 'Отзывы';
        $url = route('admin.comments.crud.get');
        $form = route('admin.comments.form');
        return view('admin.model.comments.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Comment::find($id);
        $params = ['redirect' => 'admin.comments.form'];
        if ($id != null)
            $params['id'] = $id;
        $action = route('admin.comments.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('admin.model.comments.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Comment::find($id);
        } else {
            $comments = Comment::query()->with(['owner', 'replies']);
            $result = BootstrapTableHelper::processTableRequest($request, $comments, self::SEARCH_FIELDS);
            $result['rows'] = $result['rows']->each(function ($item) {
                $item->user_name = e($item->user_name);
                $item->text = e($item->text);
            });
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $comment = Comment::create($data);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $comment->id]));
        } else
            $response = $comment;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $comment = Comment::find($id);
        $comment->fill($data);
        $comment->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $comment->id]));
        } else
            $response = $comment;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Comment::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    public function set_status(Request $request)
    {
        $Input = $request->all();
        $Comment = Comment::find($Input['comment']);
        $Comment->status = $Input['status'];
        $Comment->save();
        return $Comment;
    }

    public function reply(\Illuminate\Http\Request $request, $id)
    {
        $returnUrl = $request->input('return', route('admin.comments.list'));
        $text = $request->input('text');

        Comment::find($id)->replies()->create([
            'user_rate' => 10,
            'user_name' => 'iDoctor',
            'user_email' => 'idoctor.kz',
            'text' => $text,
            'created_at' => Carbon::now()->timestamp,
            'updated_at' => Carbon::now()->timestamp
        ]);
        return redirect()->back();
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
