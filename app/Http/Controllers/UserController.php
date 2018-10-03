<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelper;
use App\Helpers\SearchHelper;
use App\Http\Requests\User\StoreOrderUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected function getCreateValidatorRules()
    {
        return [
            'name' => 'required',
            'phone' => Rule::unique('users'),
            'city_id' => 'required'
        ];
    }

    protected function getUpdateValidatorRules($user)
    {
        return [
            'name' => 'required',
            'phone' => Rule::unique('users')->ignore($user->id, 'id'),
            'city_id' => 'required'
        ];
    }

    protected $validatorMessages =
        [
            'phone.unique' => 'Данный номер телефона уже зарегистрирован.',
            'city_id.required' => 'Укажите город',
            'name.required' => 'Укажите имя'
        ];

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */

    public function getTableView(Request $request)
    {
        $url = route('admin.users.crud.get');
        $form = route('admin.users.form');
        return view('admin.table.users', compact('url', 'form'));
    }

    public function getForm(Request $request, $name = 'edit', $id = null)
    {
        $seed = $id != null && !(session('errors') && session('errors')->any()) ? User::find($id) : session()->getOldInput();
        $action = route('admin.users.crud.saveOrderUser', ['redirect' => 'admin.users.form', 'redirect_name' => 'admin.model.orders.client-form']);
        $readonly = $request->input('readonly');
        return view('admin.model.orders.client-form', compact('action', 'seed', 'readonly'));
    }

    public function getFormView(Request $request, $id = null)
    {
        // TODO: Implement getFormView() method.
    }

    public function processRequest($request)
    {
        $data = parent::processRequest($request);
        if (array_has($data, 'phone'))
            $data['phone'] = FormatHelper::phone($data['phone']);
        return $data;
    }

    public function get(Request $request, $id = null)
    {
        if ($id == null) {
            $orders = User::with(['city']);
            $result = SearchHelper::processDataTableRequest($request, $orders, ['name', 'city' => ['name'], 'phone']);
        } else {
            $result = User::find($id);
        }


        return $result;
    }

    public function searchClientsByPhone(Request $request)
    {
        $phone = $request->input('phone');
        return User::where('role', 3)->where('phone', 'like', '%' . $phone . '%')->get();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $columns = $request->input('columns');
            $search = $request->input('search');
            $users = User::query()->where('role', 3);
            $usersFiltered = SearchHelper::searchByFields($users, $columns, $search)->get();
            return ['users' => $usersFiltered];
        } else {
            return view('admin.users.components.searchlist', ['inputDivId' => 'searchusers', 'listDivId' => 'searchuserslist']);
        }
    }

    public function saveOrderUser($id = null, StoreOrderUserRequest $request)
    {
        $data = $request->all();
        if (isset($data['id']))
            $user = User::find($data['id']);
        else
            $user = new User();
        $user->fill($data);
        $user->save();

        return response()->redirectTo(route('admin.users.form', ['name' => 'admin.model.orders.client-form', 'id' => $user->id,
            'readonly' => true]));
    }


}
