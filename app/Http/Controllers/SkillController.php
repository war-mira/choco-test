<?php

namespace App\Http\Controllers;

use App\City;
use App\Doctor;
use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $model = Skill::class;
    protected $searchFields = ['name'];
    protected $deafaultFields = ['top_doctors' => [], 'position' => 0, 'category' => 0];
    protected $identities = false;

    public function getTableView(Request $request)
    {
        $url = route('admin.skills.crud.get');
        $form = route('admin.skills.form');
        return view('admin.table.skills', compact('url', 'form'));
    }

    public function getFormView(Request $request, $id = null)
    {
        $seed = Skill::find($id);
        $action = route('admin.skills.crud.' . ($id == null ? 'create' : 'update'), ['id' => $id, 'redirect' => 'admin.skills.form']);
        return view('forms.admin.skill', compact('seed', 'action'));
    }

    public function showSkillDoctors(City $city, Skill $skill, Request $request)
    {
        $filter = $request->only(['q', 'type', 'order', 'sort', 'skill', 'medcenter', 'child', 'ambulatory']);

        $filter['type'] = 'skills';
        $filter['skill'] = $skill->alias;
        $cityId = $city->id;

        $doctors = Doctor::query()->where('doctors.status', 1)
            ->where('doctors.city_id', $city->id)
            ->whereHas('skills', function ($skillsQuery) use ($skill) {
                $skillsQuery->where('skills.id', $skill->id);
            })
            ->paginate(10);


        $skills = \App\Skill::query()->with('doctors')->withCount(['doctors' => function ($query) use ($cityId) {
            $query->where('doctors.status', 1)
                ->where('city_id', $cityId);
        }])->whereHas('doctors', function ($query) use ($cityId) {
            $query->where('doctors.status', 1)
                ->where('city_id', $cityId);
        })->orderBy('name')->get();

        $medcenters = \App\Medcenter::query()->with('doctors')->withCount(['doctors' => function ($query) use ($cityId) {
            $query->where('doctors.status', 1)
                ->where('doctors.city_id', $cityId);
        }])->whereHas('doctors', function ($query) use ($cityId) {
            $query->where('doctors.status', 1)
                ->where('doctors.city_id', $cityId);
        })->orderBy('name')->get();


        return view('search.page',
            compact('meta', 'doctors', 'skills', 'medcenters', 'filters', 'filter'));
    }

}
