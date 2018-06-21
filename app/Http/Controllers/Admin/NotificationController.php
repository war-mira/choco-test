<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SmsNotification\SendStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SmsNotification\StoreSmsNotificationRequest;
use App\SmsNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getForDate(Request $request)
    {


        $dateStr = $request->input('date', (Carbon::today())->format('Y-m-d'));
        $date = Carbon::createFromFormat('Y-m-d', $dateStr);

        $start = $date->startOfDay()->format('Y-m-d H:i');
        $end = $date->endOfDay()->format('Y-m-d H:i');;
        $notifications = SmsNotification::query()->whereIn('send_status', [SendStatus::SENT, SendStatus::ERROR])->whereBetween('created_at', [$start, $end])->orderByDesc('id')->get();

        return view('admin.model.notifications.table', compact('dateStr', 'notifications'));
    }


    public function save($id, StoreSmsNotificationRequest $request)
    {
        $notification = SmsNotification::findOrNew($id);

        $data = $request->input();


        $notification->fill($data);
        $notification->save();
        return $notification;
    }

    public function setConfirm($id, Request $request)
    {
        $notification = SmsNotification::findOrFail($id);
        $status = $request->input('status');
        $notification->update(['confirm_status' => $status]);
        return $notification;
    }

    public function resend($id, Request $request)
    {

    }
}
