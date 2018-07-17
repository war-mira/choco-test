<?php

namespace App\Http\Controllers;

use App\City;
use App\Doctor;
use App\Helpers\FormatHelper;
use App\Helpers\SearchHelper;
use App\Helpers\SeoMetadataHelper;
use App\Medcenter;
use App\PageSeo;
use App\Skill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{

    public function item(City $city, Doctor $doctor)
    {
        if ($city->id !== $doctor->city->id) {
            return redirect()->route('doctor.item', ['doctor' => $doctor->alias]);
        }

        $meta = SeoMetadataHelper::getMeta($doctor, $city);

        $near_docs = Doctor::query()->where('doctors.status', 1)
            ->where('doctors.city_id', $doctor->city->id)->limit(9)->get();

        return view('doctors.item')
            ->with('meta', $meta)
            ->with('near', $near_docs)
            ->with('doctor', $doctor);
    }

    public function commonList(Skill $skill = null, Request $request){
        return $this->list(City::find(1), $skill, $request);
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

        $doctorsTop = null;
        $currentPage = $request->input('page');

        if(isset($skill))
        {
            $filter['skill'] = $skill->alias ?? null;
            $doctors = $doctors->whereHas('skills', function ($skillsQuery) use ($skill) {
                $skillsQuery->where('skills.id', $skill->id);
            });
            $top_doctors = FormatHelper::arrayToString($skill->top_doctors);
            if($top_doctors && $skill->top_doctors){
                $doctorsTop = Doctor::whereIn('id', $skill->top_doctors)->orderByRaw('FIELD(id,'.$top_doctors.')')->get();
            }

        }

        if(isset($doctorsTop)){
            $doctors = $doctors->whereNotIn('id', $skill->top_doctors);
        }

        if (isset($filter['page']) && $filter['page'] == 1){
            return redirect()->route(((empty($city->id) || $city->id == 1) ? "all.doctors.list" : 'doctors.list'), array_merge(['city' => $city->alias ?? null, 'skill' => $skill->alias ?? null], array_except($filter, 'page')));
        }

        $this->applyDoctorsFilter($doctors, $filter);


        if (!empty($city->id) && $city->id != 1) {
            $doctors = $doctors->where('doctors.city_id', $city->id);

            $pageSeo = PageSeo::query()
                ->where('class','Doctor')
                ->where('action', 'list')
                ->first();
            $meta = SeoMetadataHelper::getMeta($pageSeo, $city);
        } else {
            $title = 'iDoctor.kz - Врачи-специалисты. Список врачей-специалистов в Казахстане';
            $description = 'iDoctor.kz - Список врачей-специалистов по всему Казахстану. Поиск и бесплатная запись на прием к врачу любой специальности. У нас собрана большая база врачей различных специализаций по всему Казахстану';
            $meta = compact('title', 'description');
        }
        $doctors = $doctors->paginate(10)->appends($query);

        if ($doctors->lastPage() < ($filter['page'] ?? 1)){
            return redirect($doctors->url(1));
        }

        $skills = \App\Skill::orderBy('name');
        if (!empty($city->id)) {
            $skills = $skills->havingDoctorsInCity($city);
        }
        $skills = $skills->get();

        $medcenters = \App\Medcenter::orderBy('name');
        if (!empty($city->id)) {
            $medcenters = $medcenters->havingDoctorsInCity($city);
        }
        $medcenters = $medcenters->get();

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

            //compact('meta', 'doctors', 'skills', 'medcenters', 'filter', 'query'));

            compact('meta', 'doctors', 'doctorsTop', 'skills', 'medcenters', 'filter', 'query', 'city', 'currentPage'));
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
        if(isset($filter['district']) && $filter['district']){
            $doctors->leftJoin('medcenters', 'medcenters.id', '=', 'doctors.med_id')->where('medcenters.district_id', $filter['district']);
        }
        if (isset($filter['q']) && $filter['q'] && trim($filter['q']) != '')
            SearchHelper::searchByFields($doctors, ['firstname', 'lastname', 'skills' => ['name']], $filter['q']);

        $order = [$filter['sort'] ?? 'rate', $filter['order'] ?? 'desc'];
        if ($order[0] == 'rate')
            $doctors->orderBy('rate', $order[1]);
        else if ($order[0] == 'price')
            $doctors->orderBy('price', $order[1]);
        else if ($order[0] == 'orders_count')
            $doctors->orderBy('orders_count', $order[1]);
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

    public function getall(Request $request)
    {
        $doto = [];

        if($request->ajax())
        {
            $type = $request->post('ttype');
            if($type == 'all')
            {
                if($request->post('query')) {
                    $data = Doctor::where('firstname', 'like', $request->post('query'))
                        ->Orwhere('lastname', 'like', $request->post('query'))
                        ->Orwhere('patronymic', 'like', $request->post('query'))
                        ->orderBy('firstname', 'ASC')->get();

                    foreach ($data as $o => $dt) {
                        $doto[$o] = [
                            'text' => $dt->lastname . ' ' . $dt->firstname . ' ' . $dt->patronymic,
                            'img' => ($dt->avatar ? $dt->avatar : URL::asset('images/no-userpic.gif')),
                            'spec' => $dt->getMainSkillAttribute()->name,
                            'value' => $dt->id,
                            'optgroup' => 'Врачи'
                        ];
                    }
                }
                else
                {
                    $data = Doctor::where('')
                        ->orderBy('firstname', 'ASC')->get();

                    foreach ($data as $o => $dt) {
                        $doto[$o] = [
                            'text' => $dt->lastname . ' ' . $dt->firstname . ' ' . $dt->patronymic,
                            'img' => ($dt->avatar ? $dt->avatar : URL::asset('images/no-userpic.gif')),
                            'spec' => $dt->getMainSkillAttribute()->name,
                            'value' => $dt->id,
                            'optgroup' => 'Врачи'
                        ];
                    }
                }
            }
            else
            {
                $data = Skill::select('*')->orderBy('name','ASC')->get();

                foreach ($data as $o=>$dt)
                {
                    $doto[$o] = [
                        'text'=>$dt->name,
                        'count' => $dt->doctors()->count(),
                        'value'=>$dt->alias,
                        'optgroup'=>'Специализации'
                    ];
                }
            }
            return response()->json($doto);
        }
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
