<?php

namespace App\Http\Controllers;


use App\City;
use App\Helpers\SearchHelper;
use App\Medcenter;
use App\Helpers\SeoMetadataHelper;
use App\PageSeo;
use Illuminate\Http\Request;

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
            'page'
        ]);
        $filter = $query;

        $this->applyMedcentersFilter($medcenters, $filter);

        if ($city) {
            $medcenters = $medcenters->whereCityId($city->id);
            $pageSeo = PageSeo::query()
                ->where('class','Medcenter')
                ->where('action', 'list')
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
        if (isset($filter['q']) && $filter['q'] && trim($filter['q']) != '')
            SearchHelper::searchByFields($medcenters, ['name', 'content'], $filter['q']);

        $order = [$filter['sort'] ?? 'rate', $filter['order'] ?? 'desc'];
        if ($order[0] == 'rate')
            $medcenters->orderBy('rate', $order[1]);
        else if ($order[0] == 'price')
            $medcenters->orderBy('price', $order[1]);
        else if ($order[0] == 'comments_count')
            $medcenters->withCount('publicComments')->orderBy('public_comments_count', $order[1]);
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
            //return redirect()->route('medcenter.item', ['medcenter' => $medcenter->alias]);
        }

        $doctors = $medcenter->doctors()->where('doctors.status', 1)->get();
        $comments = $medcenter->allComments()->where('status', 1)->orderByDesc('created_at')->limit(5)->get();

        $meta = SeoMetadataHelper::getMeta($medcenter, $city);

        return view('medcenters.item')
            ->with('meta', $meta)
            ->with('medcenter', $medcenter)
            ->with('city', $medcenter->city)
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


}
