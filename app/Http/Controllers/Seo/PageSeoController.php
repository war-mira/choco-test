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
use App\PageSeo;
use App\Skill;
use Illuminate\Http\Request;

class PageSeoController extends Controller
{

    public function tableView()
    {
        $dataSrc = route('seo.pageseo.table.data');
        return view('seo.pageseo.table', compact('dataSrc'));
    }

    public function tableData(Request $request)
    {

        $query = PageSeo::select(['id', 'class', 'action', 'title', 'description', 'keywords']);
        $response = SearchHelper::processDataTableRequest($request, $query, ['class', 'action', 'title', 'description', 'keywords']);
        return $response;
    }

    public function formView($id)
    {
        $pageseo = PageSeo::findOrFail($id);
        return view('seo.pageseo.form', compact('pageseo'));

    }

    public function formSave($id, Request $request)
    {
        $pageseo = PageSeo::findOrFail($id);
        $attributes = $request->only(['title', 'description', 'keywords', 'h1', 'seo_text']);
        $pageseo->fill($attributes);
        $pageseo->save();
        return view('seo.pageseo.form', compact('pageseo'));
    }


}