<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    const FILE_FIELDS = ['cover_image'];
    const DEFAULT_FIELDS = [
        'is_top' => 0,
        'status' => 0
    ];
    const SEARCH_FIELDS = [
        'title',
        'alias',
        'content',
        'content_lite',
        'meta_title',
        'meta_key',
        'meta_desc'
    ];

    public function getTableView(Request $request)
    {
        $tableName = 'Посты';
        $url = route('admin.posts.crud.get');
        $form = route('admin.posts.form');
        return view('admin.model.posts.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Post::find($id) ?? [];
        $action = route('admin.posts.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.posts.form']);
        return view('admin.model.posts.form', compact('seed', 'action', 'doctorsMedcenters'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Post::find($id);
        } else {
            $orders = Post::query();
            $result = BootstrapTableHelper::processTableRequest($request, $orders, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $post = Post::create($data);

        $this->postProcessPost($post);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $post->id]));
        } else
            $response = $post;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $post = Post::find($id);
        $post->fill($data);
        $post->save();

        $this->postProcessPost($post);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $post->id]));
        } else
            $response = $post;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Post::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function postProcessPost($post)
    {


        $titleTrans = \Slug::make($post->title);
        $words = preg_split("/[^A-Za-z0-9]/", $titleTrans);
        $index = 0;
        $alias = $post->id;
        while (strlen($alias) < 50 && count($words) > $index) {
            if (strlen($words[$index]) > 0)
                $alias .= "-" . $words[$index];
            $index++;
        }
        $post->alias = $alias;
        $post->save();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();
        $data['alias'] = \Slug::make($data['title']);

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
