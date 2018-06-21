<?php

namespace App\Http\Controllers\Admin;

use App\Callback;
use App\Helpers\BootstrapTableHelper;
use App\Helpers\FormatHelper;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    const DEFAULT_FIELDS = [];
    const SEARCH_FIELDS = ['client_name', 'client_phone'];

    public function getTableView(Request $request)
    {
        $tableName = 'Заявки';
        $url = route('admin.callbacks.crud.get');
        $form = route('admin.callbacks.form');
        return view('admin.model.callbacks.table', compact('url', 'form', 'tableName'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Callback::find($id);
        if ($seed->status == 0) {
            $seed->status = 1;
            $seed->save();
        }
        $action = route('admin.callbacks.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.callbacks.form']);
        return view('admin.model.callbacks.form', compact('seed', 'action'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Callback::find($id);
        } else {
            $callbacks = Callback::query()->with(['target', 'order']);
            $result = BootstrapTableHelper::processTableRequest($request, $callbacks, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);
        $callback = Callback::create($data);

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $callback->id]));
        } else
            $response = $callback;

        return $response;
    }

    public function update($id, Request $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        $callback = Callback::find($id);
        $callback->fill($data);
        $callback->save();

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $callback->id]));
        } else
            $response = $callback;

        return $response;
    }

    public function delete(Request $request, $id)
    {
        Callback::find($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();

        if (isset($data['client_phone']))
            $data['client_phone'] = FormatHelper::phone($data['client_phone']);

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }

    public function createOrderFrom($id)
    {
        $callback = Callback::find($id);
        $callback->status = 2;
        $callback->save();
        if ($callback->order()->exists())
            return redirect(route('admin.orders.form', ['id' => $callback->order->id]));
        $data = [
            'callback_id' => $id,
            'city_id' => $callback['city_id'] ?? null,
            'operator_id' => $callback['operator_id'] ?? null,
            'client_id' => $callback['client_id'] ?? null,
            'phone' => FormatHelper::phone($callback['client_phone'] ?? null),
            'client_name' => $callback['client_name'],
            'status' => 0,
            'from_internet' => 1
        ];

        if ($callback['target_type'] == 'Doctor')
            $data['doc_id'] = $callback['target_id'];
        else if ($callback['target_type'] == 'Medcenter')
            $data['med_id'] = $callback['target_id'];
        $order = Order::create($data);

        return redirect(route('admin.orders.form', ['id' => $order->id]));
    }
}
