<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Helpers\SearchHelper;
use App\Helpers\SessionContext;
use App\Medcenter;
use App\Skill;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function livesearchIndex(Request $request)
    {
        $query = $request->query('q');
        $groups = [
            'skills'     => $this->searchSkills($query),
            'doctors'    => $this->searchDoctors($query),
            'medcenters' => $this->searchMedcenters($query)
        ];
        return view('search.liveresults_index_new', $groups);
    }

    public function livesearch(Request $request)
    {
        $query = $request->query('q');
        $is_child = $request->query('child');
        $ambulatory = $request->query('ambulatory');
        $groups = [
            $this->old_searchSkills($query),
            $this->old_searchDoctors($query, $is_child, $ambulatory),
            $this->old_searchMedcenters($query)
        ];
        return view('search.liveresults', compact('groups'));
    }

    private function searchSkills($query)
    {
        $skills = Skill::
        where('name', 'like', "%$query%")
            ->with(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->withCount(['doctors' => function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            }])
            ->whereHas('doctors', function ($query) {
                $query->where('status', 1)->where('city_id', SessionContext::cityId());
            })
            ->orderBy('name')
            ->limit(20)
            ->get();

        return $skills;
    }

    private function searchDoctors($query)
    {
        $doctors = Doctor::where('status', 1)->where('city_id', Session::get('cityid', 6));
        $doctors = $doctors->
        where(function (Builder $q) use ($query) {
            $q->where('firstname', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%")
                ->orWhereHas('skills', function (Builder $skillsQuery) use ($query) {
                    $skillsQuery->where('name', 'like', "%$query%");
                });
        })
            ->orderBy('lastname', 'asc')
            ->limit(20)
            ->get();


        return $doctors;
    }

    private function searchMedcenters($query)
    {
        $medcenters = Medcenter::whereStatus(1)
            ->where('name', 'like', "%$query%")
            ->orderBy('name', 'asc')
            ->limit(20)
            ->get();

        return $medcenters;
    }

    public function searchClients(Request $request)
    {
        $query = $request->input('q');
        $users = User::whereRole(3)->orderBy('name', 'asc');
        $words = explode(' ', $query);
        foreach ($words as $word) {
            if ($word != '')
                $users = $users->where(function ($q) use ($word) {
                    $q->where('name', 'like', "%$word%")
                        ->orWhere('phone', 'like', "%$word%");
                });
        }
        $users = $users->get();

        $groups = [[
            'results' => [
                'view' => 'search.result.user',
                'data' => $users
            ]
        ]];
        return view('search.liveresults', compact('groups'));
    }

    public function new_searchPage(Request $request, $primarySuffix = false, $secondarySuffix = false)
    {
        $type = $request->input('type', 'doctor');
        $sort = $request->input('sort', 'rate');
        $order = $request->input('order', 'desc');
        $q = $request->input('q', false);
        $child = $request->input('child', null);
        $ambulatory = $request->input('ambulatory', null);

        $doctors = Doctor::query()
            ->withCommentsCount()
            ->where('status', 1)->where('city_id', Session::get('cityid', 6));
        if ($q) {
            $doctors = $doctors->
            where(function (Builder $query) use ($q) {
                $query->where('firstname', 'like', "%$q%")
                    ->orWhere('lastname', 'like', "%$q%")
                    ->orWhereHas('skills', function (Builder $skillsQuery) use ($q) {
                        $skillsQuery->where('name', 'like', "%$q%");
                    });
            });
        }
        if (isset($child)) {
            $doctors->where('child', $child);
        }
        if (isset($ambulatory)) {
            $doctors->where('ambulatory', $ambulatory);
        }
        $doctors = $doctors->orderBy($sort, $order)->paginate(10);
        $doctors = $doctors->appends($request->query());

        return view('redesign.search.doctors', compact(
            'doctors',
            'sort',
            'order',
            'child',
            'type',
            'ambulatory',
            'q'
        ));
    }

    public function searchPage(Request $request)
    {
        $filter = $request->only(['q', 'page', 'type', 'order', 'sort', 'skill', 'medcenter', 'child', 'ambulatory']);
        if (isset($filter['skill'])) {
            $skill = Skill::query()->where('id', $filter['skill'])->firstOrFail()->alias;
            return redirect()->route('doctors.list', compact('skill'));
        } else {
            $filter = array_merge(['skill' => null], $filter);
            return redirect()->route('doctors.list', $filter);
        }

        $city = SessionContext::city();
        $cityId = $city->id;
        $doctors = Doctor::query()->where('doctors.status', 1)
            ->where('doctors.city_id', $cityId)->paginate(10)->appends($request->query());


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
            compact('meta', 'doctors', 'skills', 'medcenters', 'filter'));
    }

    private function old_searchMedcenters($query)
    {
        $medcenters = Medcenter::whereStatus(1)
            ->where('name', 'like', "%$query%")
            ->orderBy('name', 'asc')
            ->limit(20)
            ->get();

        return [
            'header' => 'Медцентры',
            'results' => [
                'view' => 'search.result.medcenter',
                'data' => $medcenters
            ]
        ];
    }

    private function old_searchDoctors($query, $is_child, $ambulatory)
    {
        $doctors = Doctor::where('status', 1)->where('city_id', Session::get('cityid', 6));
        if ($is_child == 'true')
            $doctors = $doctors->where('child', 1);
        if ($ambulatory == 'true')
            $doctors = $doctors->where('ambulatory', 1);
        $doctors = $doctors->
        where(function ($q) use ($query) {
            $q->where('firstname', 'like', "%$query%")
                ->orWhere('lastname', 'like', "%$query%");
        })
            ->orderBy('lastname', 'asc')
            ->limit(20)
            ->get();

        return [
            'header' => 'Доктора',
            'results' => [
                'view' => 'search.result.doctor',
                'data' => $doctors
            ]
        ];
    }

    private function old_searchSkills($query)
    {

        $skills = Skill::
        where('name', 'like', "%$query%")
            ->orderBy('name', 'asc')
            ->limit(20)
            ->get();

        return [
            'header' => 'Специализации',
            'results' => [
                'view' => 'search.result.skill',
                'data' => $skills
            ]
        ];
    }

    public function searchResults(Request $request)
    {
        $cityId = \App\Helpers\SessionContext::city()->id;
        $doctors = \App\Doctor::query()->where('status', 1)->where('city_id', $cityId);

        $search = $request->input('q', null);
        $doctorsFilter = $request->input('filter', false);
        if ($doctorsFilter) {
            if (isset($doctorsFilter['avg_rate']) && $doctorsFilter['avg_rate']) {
                $doctors = $doctors->whereBetween('avg_rate', $doctorsFilter['avg_rate']);
            }
            if (isset($doctorsFilter['exp']) && $doctorsFilter['exp']) {
                $max = Carbon::now()->subYear($doctorsFilter['exp'][0]);
                $min = Carbon::now()->subYear($doctorsFilter['exp'][1]);
                $doctors->whereBetween('works_since', [$min->format('Y-m-d'), $max->format('Y-m-d')]);
            }
            if (isset($doctorsFilter['price']) && $doctorsFilter['price']) {
                $doctors->whereBetween('price', $doctorsFilter['price']);
            }
            if (isset($doctorsFilter['child']) && $doctorsFilter['child']) {
                $doctors->where('child', $doctorsFilter['child']);
            }
            if (isset($doctorsFilter['ambulatory']) && $doctorsFilter['ambulatory']) {
                $doctors->where('ambulatory', $doctorsFilter['ambulatory']);
            }
            if (isset($doctorsFilter['medcenter']) && $doctorsFilter['medcenter']) {
                $doctors = $doctors->whereHas('medcenters', function ($query) use ($doctorsFilter) {
                    $query->where('medcenters.id', $doctorsFilter['medcenter']);
                });
            }
            if (isset($doctorsFilter['skill']) && $doctorsFilter['skill']) {
                $highlightSkill = Skill::find($doctorsFilter['skill']);
                $doctors = $doctors->whereHas('skills', function ($query) use ($doctorsFilter) {
                    $query->where('skills.id', $doctorsFilter['skill']);
                });
            }

        }


        if ($search && trim($search) != '')
            $doctors = SearchHelper::searchByFields($doctors, ['firstname', 'lastname', 'skills' => ['name']], $search);

        $order = $request->input('order', false);
        if ($order) {
            if ($order[0] == 'rate')
                $doctors = $doctors->orderBy('rate', $order[1]);
            else if ($order[0] == 'price')
                $doctors = $doctors->orderBy('price', $order[1]);
            else if ($order[0] == 'exp')
                $doctors = $doctors->orderBy('works_since', $order[1] == 'asc' ? 'desc' : 'asc');
            else if ($order[0] == 'comments_count')
                $doctors = $doctors->withCount('publicComments')->orderBy('public_comments_count', $order[1]);
        }

        $doctorsCount = $doctors->count();
        $page = $request->input('page', 1);
        if ($doctorsCount < ($page - 1) * 10)
            $page = 1;
        $doctors = $doctors->paginate(10, ['*'], 'page', $page);

        $pagination = (string)$doctors->links('vendor.pagination.ajax');


        return [
            'doctorsCount' => $doctorsCount,
            'page'         => $page,
            'pagination'   => $pagination,
            'view'         => view('search.doctors-page', compact('doctors', 'highlightSkill'))->render()];
    }

}