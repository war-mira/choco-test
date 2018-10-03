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
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class SkillController extends Controller
{

    public function tableView()
    {
        $dataSrc = route('seo.skills.table.data');
        return view('seo.skills.table', compact('dataSrc'));
    }

    public function tableData(Request $request)
    {

        $query = Skill::select(['id', 'name', 'alias', 'meta_title', 'meta_key', 'meta_desc', 'seo_text']);
        $response = SearchHelper::processDataTableRequest($request, $query, ['name', 'alias', 'meta_title', 'meta_key', 'meta_desc','seo_text']);
        return $response;
    }

    public function formView($id)
    {
        $skill = Skill::findOrFail($id);
        return view('seo.skills.form', compact('skill'));

    }

    public function formSave($id, Request $request)
    {
        $skill = Skill::findOrFail($id);
        $attributes = $request->only(['meta_title', 'seo_h1', 'meta_key', 'meta_desc', 'description', 'seo_text']);
        $skill->fill($attributes);
        $skill->save();

        return view('seo.skills.form', compact('skill'));

    }


}