<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\PageNotification;
use Illuminate\Http\Request;

class PageNotificationController extends Controller
{
    public function getTableView(Request $request)
    {
        $tableName = 'Оповещения на сайте';
        $url = route('admin.page_notifications.crud.get');
        $form = route('admin.page_notifications.form');
        return view('admin.model.page_notifications.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = PageNotification::find($id);
        $action = route('admin.page_notifications.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.page_notifications.form']);
        return view('admin.model.page-notifications.form', compact('seed', 'action'));
    }
}
