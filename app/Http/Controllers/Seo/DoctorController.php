<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.02.2018
 * Time: 13:01
 */

namespace App\Http\Controllers\Seo;


use App\Doctor;
use App\Helpers\SearchHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function tableView()
    {
        $dataSrc = route('seo.doctors.table.data');
        return view('seo.doctors.table', compact('dataSrc'));
    }

    public function tableData(Request $request)
    {
        $query = Doctor::select(['id', 'lastname', 'firstname', 'city_id', 'alias', 'meta_title', 'meta_key', 'meta_desc']);
        $response = SearchHelper::processDataTableRequest($request, $query, ['lastname', 'firstname', 'city_id', 'alias', 'meta_title', 'meta_key', 'meta_desc']);
        return $response;
    }

    public function formView($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('seo.doctors.form', compact('doctor'));

    }

    public function formSave($id, Request $request)
    {
        $doctor = Doctor::findOrFail($id);
        $attributes = $request->only([
            'meta_title',
            'meta_key',
            'meta_desc',
            'meta_h1',
            'preview_text',
            'timetable',
            'about_text',
            'treatment_text',
            'exp_text',
            'grad_text',
            'community_text',
            'certs_text',
            'farm_partners',
            'seo_text',
        ]);
        $doctor->fill($attributes);
        $doctor->save();
        return view('seo.doctors.form', compact('doctor'));

    }


}