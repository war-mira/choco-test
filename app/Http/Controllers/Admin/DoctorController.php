<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Observers\DoctorObserver;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    const FILE_FIELDS = ['avatar'];
    const DEFAULT_FIELDS = [
        'child'      => 0,
        'skills'     => [],
        'ambulatory' => 0,
        'status'     => 0,
    ];
    const SEARCH_FIELDS = ['firstname', 'lastname','patronymic'
//        'medcenters' => ['name'], 'city' => ['name']
    ];

    public function getTableView(Request $request)
    {
        $tableName = 'Врачи';
        $url = route('admin.doctors.crud.get');
        $form = route('admin.doctors.form');

        return view('admin.model.doctors.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Doctor::with(['skills'])->findOrNew($id);
        $seed->load(['skills' => function ($query) {
            $query->orderBy('pivot_weight', 'desc');
        }])->load('illnesses');
        $params = [];
        if ($id != null)
            $params['id'] = $id;


        $action = route('admin.doctors.crud.' . ($id == null ? 'create' : 'update'), $params);
        return view('admin.model.doctors.form', compact('seed', 'action'));
    }

    public function getSkillRow(Request $request)
    {
        $id = $request->input('id', 0);
        return view('admin.model.doctors.form.skill-row', compact('id'));
    }

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = Doctor::with('skills')->find($id);
        } else {
            $doctors = Doctor::query()->with(['skills', 'medcenters', 'city']);

            $result = BootstrapTableHelper::processTableRequest($request, $doctors, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function create($id = false, Request $request)
    {
        if ($id)
            return $this->update($id, $request);
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        if($data['mond_from'] && $data['mond_to'])
        {
            $data['mond'] = serialize(array($data['mond_from'],$data['mond_to']));
        }

        if($data['tues_from'] && $data['tues_to'])
        {
            $data['tues'] = serialize(array($data['tues_from'],$data['tues_to']));
        }

        if($data['wedn_from'] && $data['wedn_to'])
        {
            $data['wedn'] = serialize(array($data['wedn_from'],$data['wedn_to']));
        }

        if($data['thur_from'] && $data['thur_to'])
        {
            $data['thur'] = serialize(array($data['thur_from'],$data['thur_to']));
        }

        if($data['frid_from'] && $data['frid_to'])
        {
            $data['frid'] = serialize(array($data['frid_from'],$data['frid_to']));
        }

        if($data['satu_from'] && $data['satu_to'])
        {
            $data['satu'] = serialize(array($data['satu_from'],$data['satu_to']));
        }

        if($data['sund_from'] && $data['sund_to'])
        {
            $data['sund'] = serialize(array($data['sund_from'],$data['sund_to']));
        }

        $doctor = (new Doctor($data));
        $doctor->save();

        $this->slug($doctor);

        $jobs = $data['jobs'] ?? false;
        if ($jobs !== false) {
            $doctor->jobs = $jobs;
        }

        $skills = $data['skills'] ?? false;
        if ($skills !== false) {
            $doctor->skills()->sync($skills);
        }

        $illnesses = $data['illnesses'] ?? false;
        if ($illnesses !== false) {
            $doctor->illnesses()->sync($illnesses);
        }

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $doctor->id]));
        } else
            $response = $doctor;

        return $response;
    }

    public function update($id, StoreDoctorRequest $request)
    {
        $redirectRoute = $request->query('redirect', null);
        $data = $this->processRequestData($request);

        if($data['mond_from'] && $data['mond_to'])
        {
            $data['mond'] = serialize(array($data['mond_from'],$data['mond_to']));
        }

        if($data['tues_from'] && $data['tues_to'])
        {
            $data['tues'] = serialize(array($data['tues_from'],$data['tues_to']));
        }

        if($data['wedn_from'] && $data['wedn_to'])
        {
            $data['wedn'] = serialize(array($data['wedn_from'],$data['wedn_to']));
        }

        if($data['thur_from'] && $data['thur_to'])
        {
            $data['thur'] = serialize(array($data['thur_from'],$data['thur_to']));
        }

        if($data['frid_from'] && $data['frid_to'])
        {
            $data['frid'] = serialize(array($data['frid_from'],$data['frid_to']));
        }

        if($data['satu_from'] && $data['satu_to'])
        {
            $data['satu'] = serialize(array($data['satu_from'],$data['satu_to']));
        }

        if($data['sund_from'] && $data['sund_to'])
        {
            $data['sund'] = serialize(array($data['sund_from'],$data['sund_to']));
        }

        $doctor = Doctor::find($id);
        $doctor->fill($data);

        $jobs = $data['jobs'] ?? false;
        if($jobs !== false)
        {
            $doctor->jobs = $jobs;
        }

        $doctor->save();

        $this->slug($doctor);

        $skills = $data['skills'] ?? false;
        if ($skills !== false) {
            $skills = collect($skills)->mapWithKeys(function ($skill) {
                return [$skill['id'] => ['weight' => $skill['weight']]];
            });
            $doctor->skills()->sync($skills);
        }

        $illnesses = $data['illnesses'] ?? false;
        if ($illnesses !== false) {
            $doctor->illnesses()->sync($illnesses);
        }

        if (isset($data['items'])) {
            $ids = array_reduce($data['items'], function ($carry, $item) {
                if (isset($item['id']))
                    $carry[] = $item['id'];
                return $carry;
            }, []);
            $doctor->items()->whereNotIn('id', $ids)->delete();
            foreach ($data['items'] as $itemData) {
                $item = $doctor->items()->findOrNew($itemData['id'] ?? null);
                $item->fill($itemData);
                $doctor->items()->save($item);
            }
        }

        if ($redirectRoute != null) {
            $response = redirect(route($redirectRoute, ['id' => $doctor->id]));
        } else
            $response = $doctor;

        return $response;
    }

    private function processRequestData(Request $request)
    {
        $data = $request->all();

        foreach (self::FILE_FIELDS as $fileField) {
            if ($request->hasFile($fileField) && $request->file('avatar') != null)
                $data[$fileField] = $request->file($fileField)->store('images');
            else
                unset($data['avatar']);
        }

        foreach (self::DEFAULT_FIELDS as $deafaultField => $deafaultValue) {
            if (!$request->has($deafaultField))
                $data[$deafaultField] = $deafaultValue;
        }

        return $data;
    }

    private function slug(Doctor $doctor)
    {
        $transName = \Slug::make($doctor->name);
        $doctor->alias = $doctor->id . "-" . $transName;
        $doctor->update();
    }

    public function delete(Request $request, $id)
    {
        Doctor::findOrFail($id)->delete();
        if ($request->input('back', 0) == 1)
            return back()->withInput();

    }
}
