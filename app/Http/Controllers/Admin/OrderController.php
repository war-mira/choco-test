<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Facades\NotificationService;
use App\Helpers\BootstrapTableHelper;
use App\Helpers\HtmlHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SmsNotificationResource;
use App\Http\Resources\BootstrapTableResource;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    const DEFAULT_FIELDS = [
        'status' => 0
    ];
    const SEARCH_FIELDS = [
        'client_name',
        'status',
        'operator_name',
        'operator' => ['name'],
        'client' => ['name'],
        'medcenter' => ['name'],
        'doctor' => ['lastname', 'firstname']
    ];

    public function getTableView(Request $request)
    {
        $tableName = 'Заказы';
        $url = route('admin.orders.crud.get');
        $form = route('admin.orders.form');
        $exportAction = route('admin.orders.export');
        return view('admin.model.orders.table', compact('tableName', 'url', 'form', 'exportAction'));
    }

    public function getNotifications($id, Request $request)
    {
        /** @var Order $order */
        $order = Order::findOrFail($id);
        $notifications = $order->smsNotifications()->getQuery()->with(['order']);


        return new BootstrapTableResource($notifications, SmsNotificationResource::class);
    }

    public function createNotification($id, Request $request)
    {
        /** @var Order $order */
        $order = Order::findOrFail($id);
        $type = $request->input('type');

        $notification = NotificationService::createOrderNotification($order, $type);
        return $notification;
    }

    public function export(Request $request)
    {
        $dateBeginInput = $request->input('exportDateBegin');
        $dateEndInput = $request->input('exportDateEnd');
        $dateColumn = $request->input('dateTimeColumn', 'created_at');

        $dateBegin = Carbon::createFromFormat('Y-m-d\TH:i', $dateBeginInput);
        $dateEnd = Carbon::createFromFormat('Y-m-d\TH:i', $dateEndInput);

        $name = "Заказы" . $dateBegin . "_" . $dateEnd;

        $orders = Order::whereBetween($dateColumn, [$dateBegin, $dateEnd])
            ->get();
        foreach ($orders as $order){
            if($order->status['children'])
                dd($order->status['children']);
        }
        Excel::create($name, function ($excel) use ($orders, $dateBegin, $dateEnd) {
            /** @var Excel $excel */
            $excel->sheet('Отчет', function ($sheet) use ($orders) {
                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.export.orders', compact('orders'));
            });
        })->export('xls');
    }

    public function getFormView(Request $request, $id = null)
    {
        $fromInternet = $request->query('from_internet', null);

        $seed = Order::find($id) ?? [];
        if (isset($seed->id) && $seed->status == 0) {
            $seed->status = 15;
            $seed->save();
        }
        if (isset($fromInternet))
            $seed['from_internet'] = $fromInternet;

        $doctorsMedcenters = Doctor::whereStatus(1)->get()->mapWithKeys(function ($doctor) {
            return [$doctor['id'] => $doctor->medcenters()->pluck('medcenters.id')];
        });

        $data = [
            'select2' => [
                'medcenters' => \App\Medcenter::query()
                    ->where('status', 1)
                    ->get()->map(function (\App\Medcenter $medcenter) {
                        return
                            [
                                'id'   => $medcenter->id,
                                'text' => $medcenter->name,
                                'bind' => $medcenter->doctors()->pluck('doctors.id')
                            ];
                    }),
                'doctors'    => \App\Doctor::public ()->get()->map(function (\App\Doctor $doctor) {
                    return
                        [
                            'id'   => $doctor->id,
                            'text' => $doctor->name,
                            'bind' => $doctor->medcenters()->pluck('medcenters.id')
                        ];
                })
            ]
        ];
        $action = route('admin.orders.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id]);
        return view('admin.model.orders.form', compact('seed', 'action', 'doctorsMedcenters', 'data'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Order::find($id);
        } else {
            $orders = Order::query()->with(['medcenter:id,name', 'doctor:id,lastname,firstname', 'client:id,name,phone']);
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
        $order = Order::create($data);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $order->id]));
        } else
            $response = $order;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $order = Order::find($id);
        $order->fill($data);
        $order->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $order->id]));
        } else
            $response = $order;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Order::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();

        if (isset($data['event_date']))
            $data['event_date'] = Carbon::createFromFormat("Y-m-d\TH:i", $data['event_date']);
        if (isset($data['event2_date']))
            $data['event2_date'] = Carbon::createFromFormat("Y-m-d\TH:i", $data['event2_date']);

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }
}
