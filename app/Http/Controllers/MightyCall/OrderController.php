<?php

namespace App\Http\Controllers\MightyCall;

use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getFormView(Request $request, $phone, $operator_id)
    {
        $name = $request->query('name', null);
        $fromInternet = $request->query('from_internet', null);
        $seed = [
            'client_info' => ['phone' => $phone == '00' ? '' : $phone]
        ];
        if (isset($name))
            $seed['client_info']['name'] = $name;
        if (isset($fromInternet))
            $seed['from_internet'] = $fromInternet;
        $action = route('api.order.create');

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
        return view('forms.admin.apiorder', compact('seed', 'action', 'data'));
    }

    public function create(Request $request)
    {
        $Input = $request->all();
        try {
            $birthday = Carbon::createFromFormat("d-m-Y", $Input['client']['birthday'] ?? '01-01-1900');
        } catch (\Exception $e) {
            $birthday = Carbon::create(1900, 1, 1);
        }
        $client = User::firstOrCreate(
            ['id' => $Input['client_id']],
            [
                'phone' => FormatHelper::phone($Input['client']['phone']) ?? null,
                'name' => $Input['client']['name'] ?? $Input['client_name'],
                'role' => 3,
                'birthday' => $birthday
            ]);
        $appointment = [
            'doc_id' => $Input['doc_id'] ?? null,
            'med_id' => $Input['med_id'],
            'city_id' => $Input['city_id'],
            'operator_id' => $Input['operator_id'] ?? null,
            'client_id' => $client->id,
            'event_date' => Carbon::createFromFormat('Y-m-d H:i', $Input['event_date'] ?? null),
            'event2_date' => Carbon::createFromFormat('Y-m-d H:i', $Input['event2_date'] ?? null),
            'status' => $Input['status'] ?? 15,
            'from_internet' => $Input['from_internet']
        ];

        $Order = Order::create($appointment);
        return response("Заявка сохранена!", 200);
    }
}
