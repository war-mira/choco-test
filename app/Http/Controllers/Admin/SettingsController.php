<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SmsNotification\SendStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SmsNotification\StoreSmsNotificationRequest;
use App\PageSeo;
use App\SmsNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function form(Request $request)
    {
        $items = PageSeo::all();
        $action = route('admin.settings.update');
        return view('admin.settings', compact('items', "action"));
    }

    public function update(Request $request)
    {
        $settings = $request->input("settings");

        foreach ($settings as $id => $data) {
            $post = PageSeo::find($id);
            $post->fill($data);
            $post->save();
        }
        $response = redirect(route("admin.settings.form"));
        return $response;

    }
}
