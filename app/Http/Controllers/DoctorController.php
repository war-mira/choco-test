<?php

namespace App\Http\Controllers;

use App\City;
use App\Doctor;
use App\Helpers\SearchHelper;
use App\Helpers\SeoMetadataHelper;
use App\PageSeo;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class  DoctorController extends Controller
{

    public function item(City $city, Doctor $doctor)
    {
        if ($city->id !== $doctor->city->id) {
            //return redirect()->route('doctor.item', ['doctor' => $doctor->alias]);
        }

        $meta = SeoMetadataHelper::getMeta($doctor, $city);

        return view('doctors.item')
            ->with('meta', $meta)
            ->with('doctor', $doctor);
    }

    public function list(City $city = null, Skill $skill = null, Request $request)
    {
        $cityId = $city->id;
        $doctors = Doctor::query()->where('doctors.status', 1)
            ->where('doctors.city_id', $cityId);
        $query = $request->only([
            'q',
            'child',

            'ambulatory',
            'sort',
            'order',
            'exp_range',
            'price_range',
            'rate_range',
            'page'
        ]);
        $filter = $query;

        if (isset($skill)) {
            $filter['skill'] = $skill->alias ?? null;
            $doctors = $doctors->whereHas('skills', function ($skillsQuery) use ($skill) {
                $skillsQuery->where('skills.id', $skill->id);
            });
        }
        if (isset($filter['page']) && $filter['page'] == 1)
            return redirect()->route('doctors.list', array_merge(['city' => $city->alias ?? null, 'skill' => $skill->alias ?? null], array_except($filter, 'page')));

        $this->applyDoctorsFilter($doctors, $filter);

        $doctors = $doctors->paginate(10)->appends($query);
        if ($doctors->lastPage() < ($filter['page'] ?? 1))
            return redirect($doctors->url(1));

        $skills = \App\Skill::havingDoctorsInCity($city)->orderBy('name')->get();
        $medcenters = \App\Medcenter::havingDoctorsInCity($city)->orderBy('name')->get();

        if (isset($skill)) {
            $meta = SeoMetadataHelper::getMeta($skill, $city);
        } else {
            $pageSeo = PageSeo::query()
                ->where('class','Doctor')
                ->where('action', 'list')
                ->first();
            $meta = SeoMetadataHelper::getMeta($pageSeo, $city);
        }


        return view('search.page',
            compact('meta', 'doctors', 'skills', 'medcenters', 'filter', 'query'));
    }

    private function applyDoctorsFilter($doctors, $filter)
    {
        if (isset($filter['rate_range']) && $filter['rate_range']) {
            $doctors = $doctors->whereBetween('rate', explode(',', $filter['rate_range']));
        }
        if (isset($filter['exp_range']) && $filter['exp_range']) {
            $expRange = explode(',', $filter['exp_range']);
            $max = Carbon::now()->subYear($expRange[0]);
            $min = Carbon::now()->subYear($expRange[1]);
            $doctors->whereBetween('works_since', [$min->format('Y-m-d'), $max->format('Y-m-d')]);
        }
        if (isset($filter['price_range']) && $filter['price_range']) {
            $doctors->whereBetween('price', explode(',', $filter['price_range']));
        }
        if (isset($filter['child']) && $filter['child']) {
            $doctors->where('child', $filter['child']);
        }
        if (isset($filter['ambulatory']) && $filter['ambulatory']) {
            $doctors->where('ambulatory', $filter['ambulatory']);
        }
        if (isset($filter['q']) && $filter['q'] && trim($filter['q']) != '')
            SearchHelper::searchByFields($doctors, ['firstname', 'lastname', 'skills' => ['name']], $filter['q']);

        $order = [$filter['sort'] ?? 'rate', $filter['order'] ?? 'desc'];
        if ($order[0] == 'rate')
            $doctors->orderBy('rate', $order[1]);
        else if ($order[0] == 'price')
            $doctors->orderBy('price', $order[1]);
        else if ($order[0] == 'exp')
            $doctors->orderBy('works_since', $order[1] == 'asc' ? 'desc' : 'asc');
        else if ($order[0] == 'comments_count')
            $doctors->withCount('publicComments')->orderBy('public_comments_count', $order[1]);

    }

    public function tourism_list()
    {
        $navigation = [
            [
                'name' => 'Главная',
                'href' => '/'
            ],
            [
                'name' => 'Медтуризм'
            ],
        ];
        $sort = \Request::get('sort', 'rate');
        $order = \Request::get('order', 'desc');
        $sortOptions = self::getSortOptions($sort, $order);

        $Skill = [];

        $CityArray = City::where('parent_id', '<>', 1)->where('id', '<>', 1)->get()->pluck('id');
        //return var_dump(CityArray );
        $doctors = Doctor::whereIn('city_id', $CityArray)->where('status', 1)->paginate(15);

        $meta = [
            'title'       => 'Медицинский туризм ',
            'description' => 'Медицинский туризм на сайте iDoctor.kz'
        ];
        return view('doctors.list')
            ->with(compact('sortOptions'))
            ->with(compact('navigation'))
            ->with(compact('meta'))
            ->with('Skill', $Skill)
            ->with('doctors', $doctors)
            ->with('links', $doctors->links());
    }

    public static function getSortOptions($sort, $order)
    {

        $sortOptions = [
            [
                'sort' => 'price',
                'name' => 'по цене'
            ],
            [
                'sort' => 'rate',
                'name' => 'по рейтингу'
            ],
            [
                'sort' => 'works_since',
                'name' => 'по опыту'
            ],
            [
                'sort' => 'public_comments_count',
                'name' => 'по отзывам'
            ]
        ];
        foreach ($sortOptions as $key => $option) {
            $option['current'] = $sort == $option['sort'];
            if ($option['current']) {
                $option['order'] = $order == 'asc' ? 'desc' : 'asc';
            } else
                $option['order'] = 'asc';
            $sortOptions[$key] = $option;
        }
        return $sortOptions;
    }

    public function admin_shedule($id)
    {
        $Doctor = Doctor::find($id);
        $status_array = [
            0 => '<span class="label label-info">Скрыт</span>',
            1 => '<span class="label label-success">Опубликован</span>',
            2 => '<span class="label label-danger">Удален</span>',
        ];
        return view('admin.doctors.shedule')
            ->with('Doctor', $Doctor)
            ->with('status_array', $status_array);
    }

    public function loadComments($city, $doctor, Request $request)
    {

        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);
        $comments = $doctor->comments()
            ->where('comments.status', 1)
            ->orderByDesc('updated_at');
        $total = $comments->count();

        $comments = $comments->offset($offset)
            ->limit($limit)
            ->get();

        $view = view('model.comments.ajax-list', compact('comments'))->render();
        $offset = $offset + $limit;
        $left = $total - $offset;
        $left = $left < 0 ? 0 : $left;
        return compact('view', 'offset', 'left');
    }

    public function feedback(City $city, Doctor $doctor){
        if ($city->id !== $doctor->city->id) {
            return redirect()->route('doctor.item', ['doctor' => $doctor->alias]);
        }

        $meta = SeoMetadataHelper::getMeta($doctor, $city);

        return view('doctors.feedback', compact('city', 'doctor', 'meta'));
    }


}
