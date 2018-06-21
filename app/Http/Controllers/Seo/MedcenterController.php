<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.02.2018
 * Time: 13:01
 */

namespace App\Http\Controllers\Seo;


use App\Helpers\SearchHelper;
use App\Http\Controllers\Controller;
use App\Medcenter;
use Illuminate\Http\Request;

class MedcenterController extends Controller
{

    public function tableView()
    {
        $dataSrc = route('seo.medcenters.table.data');
        return view('seo.medcenters.table', compact('dataSrc'));
    }

    public function tableData(Request $request)
    {

        $query = Medcenter::select(['id', 'name', 'alias', 'city_id', 'meta_title', 'meta_key', 'meta_desc'])->with(['city']);
        $response = SearchHelper::processDataTableRequest($request, $query, ['name', 'alias', 'city_id', 'meta_title', 'meta_key', 'meta_desc']);
        return $response;
    }


    public function formView($id)
    {
        $medcenter = Medcenter::findOrFail($id);
        return view('seo.medcenters.form', compact('medcenter'));

    }

    public function formSave($id, Request $request)
    {
        $medcenter = Medcenter::findOrFail($id);
        $attributes = $request->only(['meta_title', 'meta_key', 'meta_desc', 'meta_h1', 'content', 'content_lite', 'seo_text']);
        $medcenter->fill($attributes);
        $medcenter->save();
        return view('seo.medcenters.form', compact('medcenter'));

    }

}