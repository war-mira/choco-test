<?php

namespace App\Http\Controllers;

use App\Model\Admin\PageNotification;
use Illuminate\Http\Request;

class PageNotificationController extends Controller
{
    protected $model = PageNotification::class;
    protected $searchFields = [];
    protected $deafaultFields = ['one_time' => false, 'is_active' => false];
    protected $identities = false;

    public function getTableView(Request $request)
    {
        $url = route('admin.page_notifications.crud.get');
        $form = route('admin.page_notifications.form');
        return view('admin.model.page-notifications.table', compact('url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = PageNotification::find($id);
        $action = route('admin.page_notifications.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.page_notifications.form']);
        return view('admin.model.page-notifications.form', compact('seed', 'action'));
    }


    public function getPreview(Request $request)
    {
        $notification = new PageNotification([
            'content' => $request->input('content'),

            'id' => '1']);
        return view('components.page-notification', compact('notification'));
    }
}
