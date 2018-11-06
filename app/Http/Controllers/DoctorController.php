<?php

namespace App\Http\Controllers;

use App\City;
use App\Comment;
use App\Doctor;
use App\Helpers\CacheHelper;
use App\Helpers\FormatHelper;
use App\Helpers\SearchHelper;
use App\Helpers\SeoMetadataHelper;
use App\Helpers\SessionContext;
use App\Http\Middleware\Http2Push;
use App\Http\Requests\Doctor\DoctorFilters;
use App\Medcenter;
use App\Models\Library\Illness;
use App\PageSeo;
use App\Skill;
use App\Models\District;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use morphos\Russian\GeographicalNamesInflection;
use Psy\Util\Str;

class DoctorController extends Controller
{

    public function item(City $city, Doctor $doctor, Request $request)
    {
        $request->query->add(['model' => 'view-profile', 'id' => $doctor->id]);

        $this->clicksCount($request);
        $city_id = $doctor->city->id;
        if($city->id !== $city_id){
            return redirect(route('doctor.item',['doctor'=>$doctor->alias,'city'=>$doctor->city->alias]));
        }
        $districts  =  Cache::remember('index:districts',120, function(){
            return District::all();
        });

        $meta = SeoMetadataHelper::getMeta($doctor, $city);
        $skill_id = (!is_null($doctor->main_skill)?$doctor->main_skill->id:0);

        $near_docs = Cache::tags(['doctors'])->remember('near_doctors-city_id-'.$city_id.'-skill-'.$skill_id,120,function() use ($city_id,$doctor,$skill_id){
            //   return Doctor::query()->where('doctors.status', 1)
            //                ->where('doctors.city_id', $city_id)->whereNotNull('avatar')->limit(9)->get();
            $query = Doctor::query()->with('skills')->where('doctors.status', 1)
                ->where('doctors.city_id', $city_id);
            if($skill_id !==0){
                $query =  $query->whereHas('skills', function($q) use ($doctor){
                    $q->where('skills.id', $doctor->main_skill->id);
                });
            }


            return $query->whereNotNull('avatar')->limit(9)->get();
        });

        $services = Cache::remember('index:services-'.$doctor->id.'',120, function() use($doctor) {
           return DB::table('doctors_services')
                ->select('service_items.name AS name', 'doctors_services.price AS price')
                ->join('service_items', 'service_items.id', '=', 'doctors_services.service_id')
                ->where('doctors_services.doctor_id', $doctor->id)
                ->get();
        });

        return view('doctors.item')
            ->with('meta', $meta)
            ->with('districts', $districts)
            ->with('near', $near_docs)
            ->with('doctor', $doctor)
            ->with('services', $services);
    }

    public function commonList(Skill $skill = null, Request $request)
    {
        return $this->list(City::find(1), $skill, $request);
    }


    /**
     * Search doctors
     * TODO: unify search methods for admin and front
     *
     * @param City|null $city
     * @param Skill|null $skill
     * @param DoctorFilters $filters
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|mixed|void
     */
    public function list(City $city = null, $input = '', $modifier = '', DoctorFilters $filters)
    {
        $skill = Skill::where('alias', $input)->first();

        $search = new \App\Helpers\DoctorSearcher([$input, $modifier]);

        $search->lex()->context()->registerLog();

        $searcher = $search->filter->toArray();

        $doctors = Doctor::where('doctors.status', 1)
            ->filter($filters->add([
                'city' => $city->id,
//                             'skills'=>$skill->alias??null
            ])
                ->add($searcher));

        $query = request()->only([
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

        // remove ?page=1 from url
        if (isset($filter['page']) && $filter['page'] == 1) {
            return redirect()->route(((empty($city->id) || $city->id == 1) ? "all.doctors.list" : 'doctors.list'), array_merge(['city' => $city->alias ?? null, 'skill' => $skill->alias ?? null], array_except($filter, 'page')));
        }

        // TODO: cache
        $doctorsTop = null;
        $activeCommentsDoctor = null;
        $activeAnswersDoctor = null;
        $doubleActiveDoctor = null;
        $comercial = Doctor::where('comercial', 1)->orderBy('firstname', 'asc');
        $districts = District::all();


        // TODO: multiple skills
        if (isset($skill) && (!isset($filter['page']) || $filter['page'] == 1)){
            $top_doctors = FormatHelper::arrayToString($skill->top_doctors);
            if ($top_doctors && $skill->top_doctors) {
                $doctorsTop = Doctor::whereIn('id', $skill->top_doctors)->orderByRaw('FIELD(id,' . $top_doctors . ')')->where('status', 1)->get();
            }


            $dateStart = date("Y-m-d h:m:s", strtotime('monday this week'));
            $dateEnd = date("Y-m-d h:m:s", strtotime('sunday this week'));
            $activeCommentsDoctor = clone $doctors;
            $activeAnswersDoctor = clone $doctors;

            $activeCommentsDoctor = Cache::tags(['doctors'])->remember('active-comments-doctor:' . $skill->id, 120, function () use ($activeCommentsDoctor, $dateStart, $dateEnd) {
                return $activeCommentsDoctor->select(['doctors.*', DB::raw('count(comments.id) as total')])
                    ->leftJoin('comments', 'doctors.id', '=', 'comments.owner_id')
                    ->whereBetween('comments.created_at', [$dateStart, $dateEnd])
                    ->groupBy('doctors.id')
                    ->orderBy('total', 'DESC')
                    ->first();
            });

            $activeAnswersDoctor = Cache::tags(['doctors'])->remember('active-answers-doctor:' . $skill->id, 120, function () use ($activeAnswersDoctor, $dateStart, $dateEnd) {
                return $activeAnswersDoctor->select(['doctors.*', DB::raw('count(question_answers.id) as total')])
                    ->leftJoin('question_answers', 'doctors.id', '=', 'question_answers.doctor_id')
                    ->whereBetween('question_answers.created_at', [$dateStart, $dateEnd])
                    ->groupBy('doctors.id')
                    ->orderBy('total', 'DESC')
                    ->first();
            });

            if(isset($activeCommentsDoctor) && isset($activeAnswersDoctor) && $activeCommentsDoctor->id == $activeAnswersDoctor->id)
                $doubleActiveDoctor = $activeCommentsDoctor;

        }

        if (isset($doctorsTop))
            $doctors = $doctors->whereNotIn('doctors.id', $skill->top_doctors);

        if (isset($comercial))
            $doctors = $doctors->whereNotIn('doctors.id', $comercial->pluck('id')->toArray());

        if(isset($activeCommentsDoctor))
            $doctors = $doctors->where('doctors.id', '!=', $activeCommentsDoctor->id);

        if(isset($activeAnswersDoctor))
            $doctors = $doctors->where('doctors.id', '!=', $activeAnswersDoctor->id);

        $this->applyDoctorsFilter($doctors, $filter);


        $otherCities = \Cache::tags(['cities'])->remember('other_city_'.$city->id??0,120,function() use($city){
            return  City::where('id', '<>' , $city->id)
                ->active()->get();
        });

        /**
         *
         * $doctors = \Cache::tags(['doctors'])->remember(CacheHelper::getKeyFromUrl(),24*7*60,function() use($doctors,$query){
         * return  $doctors->paginate(10)->appends($query);
         * });
         */

        $doctors = $doctors->paginate(10)->appends($query);

        if ($doctors->lastPage() < ($filter['page'] ?? 1))
            return redirect($doctors->url(1));

        if (!isset($skill))
            $pageSeo = PageSeo::where(['class' => 'Doctor', 'action' => 'list'])->first();

        $meta = SeoMetadataHelper::getMeta($skill ?? $pageSeo, $city);

        return view('search.page',
            compact('meta','otherCities','doctors', 'doctorsTop', 'skills', 'medcenters', 'filter', 'query', 'city', 'currentPage', 'skill', 'comercial', 'districts', 'activeCommentsDoctor', 'activeAnswersDoctor', 'doubleActiveDoctor'));

    }


    public function listByIllness(City $city,Illness $illness)
    {
        $doctors = $illness->doctors()
            ->where('doctors.city_id',$city->id)
            ->paginate(10);
        $pageSeo = PageSeo::query()
            ->where('class','DoctorByIllness')
            ->where('action', 'list')
            ->first();
        if(!is_null($pageSeo)){
            $meta = SeoMetadataHelper::getMeta($pageSeo, $city,$illness);
        } else{
            $title = 'iDoctor.kz - Врачи-специалисты. Список врачей-специалистов в Казахстане';
            $description = 'iDoctor.kz - Список врачей-специалистов по всему Казахстану. Поиск и бесплатная запись на прием к врачу любой специальности. У нас собрана большая база врачей различных специализаций по всему Казахстану';
            $meta = compact('title', 'description');
        }

        return view('search.page',
            compact('meta','illness','city', 'doctors'));

    }
    public function get_dt(Request $request)
    {
        if ($request->ajax()) {
            $day = $request->get('day');

            if ($day == 'tomorrow') {
                $day = date('D', strtotime('+1 days'));
            }

            $array = [
                'Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7
            ];

            foreach ($array as $u => $k) {
                if ($day == $u) {
                    $day = $k;
                }
            }

            if ($day == 'today') {
                $day = date('n');
            }

            if ($day == 'custom') {
                $day = $request->get('day');
            }

            $doc = Doctor::query()
                ->where('doctors.id', $request->get('idc'))
                ->first();

            return response()->json([
                'times' => view('doctors.times')->with([
                    'doctor' => $doc,
                    'day'    => $day
                ])->render()
            ]);
        }
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
        if (isset($filter['district']) && $filter['district']) {
            $doctors->leftJoin('medcenters', 'medcenters.id', '=', 'doctors.med_id')->where('medcenters.district_id', $filter['district']);
        }
        if (isset($filter['q']) && $filter['q'] && trim($filter['q']) != '')
            SearchHelper::searchByFields($doctors, ['firstname', 'lastname', 'patronymic', 'skills' => ['name']], $filter['q']);

        $order = [$filter['sort'] ?? 'rate', $filter['order'] ?? 'desc'];

        $doctors->SortByRang();

//        if ($order[0] == 'rate')
//            $doctors->orderBy('rate', $order[1]);
//        else if ($order[0] == 'price')
//            $doctors->orderBy('price', $order[1]);
//        else if ($order[0] == 'orders_count')
//            $doctors->orderBy('orders_count', $order[1]);
//        else if ($order[0] == 'exp')
//            $doctors->orderBy('works_since', $order[1] == 'asc' ? 'desc' : 'asc');
//        else if ($order[0] == 'comments_count')
//            $doctors->withCount('publicComments')->orderBy('public_comments_count', $order[1]);
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

        if ($request->ajax()) {
            $type = $request->post('ttype');
            if ($type == 'all') {
                if ($request->post('query') && !empty($request->post('query'))) {
                    $data = Doctor::where('firstname', 'like', $request->post('query'))
                        ->Orwhere('lastname', 'like', $request->post('query'))
                        ->Orwhere('patronymic', 'like', $request->post('query'))
                        ->orderBy('firstname', 'ASC')->get();

                    foreach ($data as $o => $dt) {
                        $doto[$o] = [
                            'text'     => $dt->lastname . ' ' . $dt->firstname . ' ' . $dt->patronymic,
                            'img'      => ($dt->avatar ? $dt->avatar : URL::asset('images/no-userpic.gif')),
                            'spec'     => $dt->getMainSkillAttribute()->name,
                            'value'    => $dt->id,
                            'optgroup' => 'Врачи'
                        ];
                    }
                } else {/*
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
                    }*/
                }
            } else {
                $data = Skill::select('*')->orderBy('name', 'ASC')->get();

                foreach ($data as $o => $dt) {
                    $doto[$o] = [
                        'text'     => $dt->name,
                        'count'    => $dt->doctors()->count(),
                        'value'    => $dt->alias,
                        'optgroup' => 'Специализации'
                    ];
                }
            }
            return response()->json($doto);
        }
    }

    public function loadComs($city, $doctor, Request $request)
    {
        if ($request->ajax()) {
            $offset = $request->query('offset', 0);
            $limit = $request->query('limit', 10);
            $comments = $doctor->comments()
                ->where('comments.status', 1)
                ->orderByDesc('updated_at');
            $total = $comments->count();

            $comments = $comments->offset($offset)
                ->limit($limit)
                ->get();

            $comment = $comments;

            $view = view('model.comments.ajax-list', ['comments' => $comments])->render();
            $offset = $offset + $limit;
            $left = $total - $offset;
            $left = $left < 0 ? 0 : $left;
            //return compact('view', 'offset', 'left');
            return response()->json([
                'offset' => $offset,
                'left'   => $left,
                'view'   => $view
            ]);
        }
    }

    public function feedback(City $city, Doctor $doctor)
    {
        if (isset($doctor->city) && $city->id !== $doctor->city->id) {
            return redirect()->route('doctor.item', ['doctor' => $doctor->alias]);
        }

        $type = Comment::typeQR;
        $source = Comment::VISITED_SENDING;

        if (request()->has('source')) {
            $source = request()->get('source');
            if ($source == Comment::MASS_SENDING)
                $type = Comment::typeCommon;
        }

        $hash = Cookie::get('uid');
        $meta = SeoMetadataHelper::getMeta($doctor, $city);

        if (request()->has('uid'))
            if (request()->get('uid') == $hash)
                return view('doctors.feedback', compact('city', 'doctor', 'meta', 'type'));
            else
                return redirect()->route('doctor.item', ['city' => $city->alias, 'doctor' => $doctor->alias]);

        $hash = md5(str_random());
        Cookie::queue('uid', $hash, 120);

        return redirect()->route('doctor.feedback',
            [
                'city' => $city->alias,
                'doctor' => $doctor->alias,
                'uid' => $hash,
                'source' => $source,
                'utm_source' => request()->get('utm_source'),
                'utm_medium' => request()->get('utm_medium'),
                'utm_campaign' => request()->get('utm_campaign')
            ]);
    }

    public function massFeedback(City $city, Doctor $doctor)
    {
        return redirect()->route('doctor.feedback',
            [
                'city'   => $city->alias,
                'doctor' => $doctor->alias,
                'source' => Comment::MASS_SENDING,
                'utm_source' => request()->get('utm_source'),
                'utm_medium' => request()->get('utm_medium'),
                'utm_campaign' => request()->get('utm_campaign')
            ]);
    }

    public function clicksCount(Request $request)
    {
        $doctor = Doctor::getInstance($request->id);

        if($request->model == Doctor::MED_SHOW_PHONE_COUNT)
            $medcenter = Medcenter::find($request->id);
        if ($doctor || $medcenter) {
            $date = new \DateTime();
            $data = [];
            if ($request->data)
                $data['phone'] = $request->data;

            $data['date'] = $date->format('Y-m-d');
            $data['token'] = $request->session()->token();

            switch ($request->model) {
                default:

                case Doctor::FIND_DOCTOR_COUNT:

                    Redis::ZREM('doctor:' . $doctor->id . ':clicks', '{"date":"' . $data['date'] . '","token":"' . $data['token'] . '"}');

                    Redis::zadd('doctor:' . $doctor->id . ':clicks', $date->getTimestamp(), json_encode($data));

                    $data = '<strong>Спасибо!</strong> Ваша заявка была принята. Мы обязательно свяжемся с вами!';

                    break;

                case Doctor::SHOW_PHONE_COUNT:

                    Redis::zadd('doctor:' . $doctor->id . ':' . Doctor::SHOW_PHONE_COUNT . '', $date->getTimestamp(), json_encode($data));

                    $phone = substr($doctor->showing_phone, 4);

                    $data = $phone;
                    break;

                case Doctor::VIEW_PROFILE_COUNT:

                    Redis::zadd('doctor:' . $doctor->id . ':' . Doctor::VIEW_PROFILE_COUNT . '', $date->getTimestamp(), json_encode($data));

                    break;

                case Doctor::MED_SHOW_PHONE_COUNT:

                    Redis::zadd('medcenter:' . $medcenter->id . ':' . Doctor::MED_SHOW_PHONE_COUNT . '', $date->getTimestamp(), json_encode($data));

                    $phone = substr($medcenter->showing_phone, 4);

                    $data = $phone;
            }


            if ($data)
                return $data;
        }
    }

    protected function getFilterforSeo($skill, $flag)
    {
        $rules = [
            'v-voskresenye' => [''],
            'bez-vyhodnykh' => ['work_days' => 'all'],
            'kruglosutochno',

            'na-dom'         => ['ambulatory' => 1],
            'na-domu'        => ['ambulatory' => 1],
            'dlya-detey'     => ['child' => 1],
            'dlya-vzroslykh' => ['child' => 0],
            'na-kazakhskom',


            'auezovskiy-rayon'    => ['district' => 3],
            'turksibkiy-rayon'    => ['district' => 8],
            'almalinkiy-rayon'    => ['district' => 2],
            'almalinskiy-rayon'   => ['district' => 2],
            'bostandykskiy-rayon' => ['district' => 4],
            'medeuskiy-rayon'     => ['district' => 6],
            'levyi-bereg',

            'zaikanie',
            'posle-insulta',
            'dlya-autista',


            'akusher-ginekolog-reproduktolog',
            'akusher-ginekolog-khirurg',

            'detskyi-akusher-ginekolog',
            'detskyi-gastroenterolog',
            'detskyi-endokrinolog',
            'detskyi-androlog',
            'detskyi-anesteziolog',
            'detskyi-khirurg',
            'detskyi-khirurg-ortoped',
            'detskyi-khirurg-urolog',
            'detskyi-lor-otolaringolog',
            'detskyi-urolog',
            'detskyi-dermatolog',
            'detskyi-urolog',
            'detskiy-allergolog',
            'detskyi-stomatolog',

            'dermatolog-onkolog',
            'dermatolog-urolog',
            'dermatolog-khirurg',
            'dermatolog-ginekolog',

            'ginekolog-khirurg',
            'ginekolog-urolog',
            'ginekolog-onkolog',
            'ginekolog-infekcionist',
            'ginekolog-reproduktolog',

            'venerolog-ginekolog',
            'venerolog-urolog',

            'gastroenterolog-khirurg',
            'gastroenterolog-endoskopist',

            'lor-otorinolaringolog-onkolog',
            'lor-otorinolaringolog-surdolog',
            'lor-otorinolaringolog-reflektolog',
            'lor-otorinolaringolog-khirurg',

            'logoped-psikholog',
            'logoped-reabilitolog',

            'pediatr-neonatolog',
            'pediatr-pulmonolog',
            'pediatr-infekcionist',
            'pediatr-gomeopat',

            'kardiolog-endokrinolog',
            'kardiolog-revmatolog',
            'kardiolog-terapevt',

            'androlog-endokrinolog',
            'androlog-reproduktolog',
            'androlog-khirurg',

            'anesteziolog-reanimatolog',

            'endokrinolog-khirurg',

            'khirurg-ortoped',
            'khirurg-endoskopist',
            'khirurg-gepatolog',
            'khirurg-angiolog',
            'khirurg-oftalmolog',
            'khirurg-neonatolog',
            'khirurg-terapevt',
            'khirurg-mammolog',
            'khirurg-endokrinolo',
            'khirurg-proktolog',


            'stomatolog-restavrator',
            'stomatolog-protezist',
            'stomatolog-ortodont',
            'stomatolog-terapevt',
            'stomatolog-khirurg',

            'urolog-khirurg',
            'urolog-androlog',
            'urolog-nefrolog',
            'urolog-reproduktolog',
            'urolog-androlog',

            'zhenskiy-urolog',
            'allergolog-immunolog',
            'torakalnyi-khirurg',


            'logoped-defektolog',
            'logoped-psikholog',
            'logoped-afaziolog',

        ];

    }

}
