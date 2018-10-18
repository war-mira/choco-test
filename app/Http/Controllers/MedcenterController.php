<?php

namespace App\Http\Controllers;


use App\City;
use App\Comment;
use App\Doctor;
use App\Helpers\SearchHelper;
use App\Http\Requests\Doctor\DoctorFilters;
use App\Medcenter;
use App\Helpers\SeoMetadataHelper;
use App\Model\ServiceItem;
use App\PageSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class MedcenterController extends Controller
{

    public function list(Request $request, City $city)
    {
        $sort = \Request::get('sort', 'rate');
        $order = \Request::get('order', 'desc');

        $medcenters = Medcenter::whereStatus(1);

        $query = $request->only([
            'q',
            'ambulatory',
            'sort',
            'order',
            'price_range',
            'rate_range',
            'page',
            //'district',
            'child',
            'type'
        ]);
        $filter = $query;

        if (isset($filter['page']) && $filter['page'] == 1){
            return redirect()->route(((empty($city->id) || $city->id == 1) ? "all.medcenters.list" : 'medcenters.list'), array_merge(['city' => $city->alias ?? null], array_except($filter, 'page')));
        }

        $this->applyMedcentersFilter($medcenters, $filter);

        if (!empty($city->id)) {
            $medcenters = $medcenters->whereCityId($city->id);

            $actionKey = $city->id != 1 ? 'list' : 'list_all';
            $pageSeo = PageSeo::query()
                ->where('class','Medcenter')
                ->where('action', $actionKey)
                ->first();
            $meta = SeoMetadataHelper::getMeta($pageSeo, $city);
        } else {
            $title = 'iDoctor.kz - - Клиники в  Казахстане';
            $description = 'iDoctor.kz - Медициские центры оказывающие услуги по всему Казахстану';
            $meta = compact('title', 'description');
        }

        $medcenters = $medcenters->paginate(10);


        $h1_title = 'Клиники ' . $city->name;

        $sortOptions = [
            [
                'sort' => 'price',
                'name' => 'по цене'
            ],
            [
                'sort' => 'rate',
                'name' => 'по рейтингу'
            ]
        ];
        return view("search.search-medcenters-page")
            ->with('h1_title', $h1_title)
            ->with('meta', $meta)
            ->with('Medcenters', $medcenters)
            ->with('Pagination', $medcenters)
            ->with(compact('filter', 'sortOptions'));
    }

    private function applyMedcentersFilter($medcenters, $filter)
    {
        if (isset($filter['rate_range']) && $filter['rate_range']) {
            $medcenters->whereBetween('rate', explode(',', $filter['rate_range']));
        }

        if (isset($filter['price_range']) && $filter['price_range']) {
            $medcenters->whereBetween('price', explode(',', $filter['price_range']));
        }

        if (isset($filter['ambulatory']) && $filter['ambulatory']) {
            $medcenters->where('ambulatory', $filter['ambulatory']);
        }
        if (isset($filter['district']) && $filter['district']) {
            $medcenters->where('district_id', $filter['district']);
        }
        if(isset($filter['q']) && $filter['q'] && trim($filter['q']) != '' && $filter['type'] == 'medcenter')
            SearchHelper::searchByFields($medcenters, ['name', 'content'], $filter['q']);

        if(isset($filter['q']) && $filter['q'] && trim($filter['q']) != '' && $filter['type'] == 'doctor')
        {
            $ids = Doctor::leftJoin('doctors_skills',function($join){
                $join->on('doctors_skills.doctor_id','=','doctors.id');
            })->leftJoin('skills',function($rj){
                $rj->on('doctors_skills.skill_id','=','skills.id');
            })->where('doctors.firstname','like','%'.$filter['q'].'%')
                ->orWhere('doctors.lastname','like','%'.$filter['q'].'%')
                ->orWhere('doctors.patronymic','like','%'.$filter['q'].'%')
                ->orWhere('skills.name','like','%'.$filter['q'].'%')
                ->pluck('doctors.id')->toArray();

            $medcenters->whereIn('id',$ids);
        }

        if(isset($filter['child']))
        {
            $ids = Doctor::where('doctors.child','=','1')
                ->pluck('doctors.id')->toArray();

            $medcenters->whereIn('id',$ids);
        }
        $order = [$filter['sort'] ?? 'rate', $filter['order'] ?? 'desc'];
        if ($order[0] == 'rate')
            $medcenters->orderBy('rate', $order[1]);
        else if ($order[0] == 'price')
            $medcenters->orderBy('price', $order[1]);
        else if ($order[0] == 'orders_count')
            $medcenters->withCount('ordersVisited')->orderBy('orders_visited_count', $order[1]);
    }

    public function category_list($city_alias = 0)
    {
        $city = City::whereAlias($city_alias)->first();

        $medcenters = Medcenter::whereStatus(1);

        $sort = \Request::get('sort', 'rate');
        $order = \Request::get('order', 'desc');

        if ($city != null) {
            $medcenters = $medcenters->whereCityId($city->id);
            $title = 'iDoctor.kz - Клиники в городе ' . $city->name;
            $description = 'iDoctor.kz - Медициские центры в городе ' . $city->name;
        } else {
            $title = 'iDoctor.kz - - Клиники в  Казахстане';
            $description = 'iDoctor.kz - Медициские центры оказывающие услуги по всему Казахстану';
        }
        $medcenters = $medcenters->paginate(10);


        return view("medcenters.list")
            ->with('title', $title)
            ->with('description', $description)
            ->with('Medcenters', $medcenters)
            ->with('Pagination', $medcenters->links());
    }

    public function item(City $city, Medcenter $medcenter)
    {
        if ($city->id !== $medcenter->city->id) {
            return redirect()->route('medcenter.item', ['medcenter' => $medcenter->alias, 'city' => $medcenter->city->alias]);
        }

        $near_meds = Medcenter::query()->whereStatus(1)
            ->where('id','<>',$medcenter->id)
            ->where('medcenters.city_id', $medcenter->city->id)
            ->limit(9)
            ->get();

        $doctors = $medcenter->doctors()->where('doctors.status', 1)->get();

        $skills = ServiceItem::where('vendor_type','=','Doctor')->whereIn('vendor_id',$doctors->pluck('id')->toArray());

        $comments = $medcenter->allComments()->where('status', 1)->orderByDesc('created_at')->limit(5)->get();

        $meta = SeoMetadataHelper::getMeta($medcenter, $city);

        return view('medcenters.new_item')
            ->with('meta', $meta)
            ->with('medcenter', $medcenter)
            ->with('city', $medcenter->city)
            ->with('near',$near_meds)
            ->with('visible',5)
            ->with('skils',$skills)
            ->with('ost',(($medcenter->doctors()->where('doctors.status', 1)->count() - 5) > 0) ? $medcenter->doctors()->where('doctors.status', 1)->count() - 5 : 0 )
            ->with('doctors', $doctors->keyBy('id'))
            ->with('comments', $comments);
    }

    public function loadComments($city, $medcenter, Request $request)
    {
        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);
        $comments = $medcenter->allComments()
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

    public function loadDoctors($model, $id, Request $request)
    {
        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);
        $medcenter = Medcenter::find($id);
        $docs = $medcenter->publicDoctors();

        if($request->query('spec'))
        {
            $skill = $request->query('spec');
            $docs = $docs->whereHas('skills', function ($skillsQuery) use ($skill) {
                $skillsQuery->where('skills.id', $skill);
            });
        }

        if($request->query('fname') == 'comments_count')
        {
            $docs->withCount('publicComments')->orderBy('public_comments_count', $request->query('orderm', 'DESC'));
        }
        else
        {
            $docs->orderBy($request->query('fname', 'rate'),$request->query('orderm', 'DESC'));
        }

        $total = $docs->count();
        $docs_more = $docs->offset($offset)
            ->limit($limit)
            ->get();

        $view = view('model.doctor.ajax-list', compact('docs_more'))->render();
        $offset = $offset + $limit;
        $left = $total - $offset;
        $left = $left < 0 ? 0 : $left;
        return compact('view', 'offset', 'left');
    }

    public function feedback(City $city, Medcenter $medcenter)
    {
        $type = Comment::typeQR;
        $source = Comment::VISITED_SENDING;

        if (request()->has('source')) {
            $source = request()->get('source');
            if ($source == Comment::MASS_SENDING)
                $type = Comment::typeCommon;
        }

        $hash = Cookie::get('uid');
        $meta = SeoMetadataHelper::getMeta($medcenter, $city);

        if (request()->has('uid'))
            if (request()->get('uid') == $hash)
                return view('medcenters.feedback', compact('city', 'medcenter', 'meta', 'type'));
            else
                return redirect()->route('medcenter.item', ['city' => $city->alias, 'medcenter' => $medcenter->alias]);

        $hash = md5(str_random());
        Cookie::queue('uid', $hash, 120);

        return redirect()->route('medcenter.feedback',
            [
                'city' => $city->alias,
                'medcenter' => $medcenter->alias,
                'uid' => $hash,
                'source' => $source
            ]);
    }
}
