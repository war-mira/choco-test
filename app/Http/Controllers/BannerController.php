<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BannerClick;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class BannerController extends Controller
{
    public function list()
    {
        $banners = Banner::orderByDesc('date_to')->get();
        return view('admin.model.banners.list', ['banners' => $banners]);
    }

    public function delete($id)
    {
        Banner::find($id)->delete();
    }

    public function create(Request $request)
    {
        $content= $request->input('position');
        $newBanner = Banner::create();
        $newBanner->position = $content;
        $newBanner->save();
        return $newBanner;
    }

    public function update($id)
    {
        $banner = Banner::find($id);


        $data = Input::all();

        if(array_has($data,'image_desktop')) {
            $imagePath = Input::file('image_desktop')->store('photos');
            $data['image_file_desktop'] = $imagePath;
        }
        if(array_has($data,'image_mobile')) {
            $imagePath = Input::file('image_mobile')->store('photos');
            $data['image_file_mobile'] = $imagePath;
        }


        $banner->update($data);
        $banner->save();

        return $data;
    }

    public function showStatistics(Request $request)
    {
        $start = $request->input('start', (new Carbon('first day of this month'))->format('Y-m-d'));
        $end = $request->input('end', (new Carbon('last day of this month'))->format('Y-m-d'));
        $startdate = Carbon::createFromFormat('Y-m-d', $start);
        $enddate = Carbon::createFromFormat('Y-m-d', $end);
        $banners = Banner::all();
        foreach ($banners as $banner) {
            $clicks = $banner->clicks()->whereBetween('clicked_at', [$startdate, $enddate]);
            $banner['clicks_count'] = $clicks->count();
            $banner['unique_clicks_count'] = $clicks->get()->unique('fingerprint')->count();
        }
        if ($request->input('export', false))
            return $this->export($banners, $start, $end);
        return view('admin.model.banners.statistics')->with(compact('banners', 'startdate', 'enddate'));
    }

    private function export($banners, $start, $end)
    {
        Excel::create('Баннера ' . $start . '_' . $end, function ($excel) use ($banners) {
            /** @var Excel $excel */
            $excel->sheet('Отчет', function ($sheet) use ($banners) {
                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.export.banners', compact('banners'));
            });
        })->export('xls');
    }

    public function click($id)
    {
        $banner = Banner::find($id);
        $click = BannerClick::create([
            'fingerprint' => \Session::getId(),
            'clicked_at' => Carbon::now(),
            'banner_id' => $banner->id
        ]);
        $href = $banner->href;
        return redirect($href);
    }
}
