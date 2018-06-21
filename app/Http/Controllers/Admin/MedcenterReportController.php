<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BootstrapTableHelper;
use App\Http\Controllers\Controller;
use App\Jobs\Report\MedcenterReportJob;
use App\Medcenter;
use App\Model\MedcenterReport;
use App\Model\MedcenterReportGroup;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;

class MedcenterReportController extends Controller
{
    const SEARCH_FIELDS = ['name', 'from', 'to', 'medcenters' => ['name']];

    public function get($id = null, Request $request)
    {
        if ($id != null) {
            $result = MedcenterReportGroup::find($id);
        } else {
            $doctors = MedcenterReportGroup::query();
            $result = BootstrapTableHelper::processTableRequest($request, $doctors, self::SEARCH_FIELDS);
        }
        return $result;
    }

    public function getTableView()
    {
        $tableName = 'Отчеты для клиник';
        $url = route('admin.medcenter-reports.get');
        $form = route('admin.medcenter-reports.group.view');

        return view('admin.reports.medcenters.table', compact('tableName', 'url', 'form'));
    }

    public function getFormView()
    {

        return view('admin.reports.medcenters.group-form');
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $from = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('from'));
        $to = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('to'));
        $medIds = $request->input('med_ids');

        $reportGroup = new MedcenterReportGroup(compact('from', 'to', 'name'));
        $reportGroup->save();
        $reports = collect($medIds)->map(function ($medId) use ($reportGroup) {
            return [
                'email' => Medcenter::find($medId)->email,
                'medcenter_id' => $medId,
                'report_group_id' => $reportGroup->id,
                'from' => $reportGroup->from,
                'to' => $reportGroup->to
            ];
        })->toArray();

        $reportGroup->reports()->createMany($reports);

        return response()->redirectTo(route('admin.medcenter-reports.group.view', ['id' => $reportGroup->id]));
    }

    public function groupView($id = false)
    {
        if (!$id)
            return response()->redirectTo(route('admin.medcenter-reports.form'));
        $group = MedcenterReportGroup::with('reports')->findOrFail($id);
        return view('admin.reports.medcenters.reports-list', compact('group'));
    }


    public function processReport($id)
    {
        $report = MedcenterReport::findOrFail($id);


        $medcenter = Medcenter::query()->find($report->medcenter_id);
        $orders = Order::query()
            ->whereBetween('event_date', [$report->from, $report->to])
            ->where('med_id', $report->medcenter_id)
            ->whereIn('status', [1, 2, 3])
            ->orderBy('status')
            ->get();
        if (empty($orders)) {
            $orders = collect([]);
        }

        $localPath = base_path("storage/temp/");
        $slugName = preg_replace("/[^a-zA-Z0-9_.\-\s]/", "", \Slug::make($medcenter->name));
        Excel::create($slugName, function ($excel) use ($orders, $medcenter, $report) {
            /** @var Excel $excel */
            $args = ['Orders' => $orders, 'Medcenter' => $medcenter, 'start' => $report->from, 'end' => $report->to];

            $excel->sheet('Отчет', function ($sheet) use ($args) {

                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.reports.export.clinic', $args);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/idoc_logo.png')); //your image path
                $objDrawing->setCoordinates('F2');
                $objDrawing->setWorksheet($sheet);

            });
        })->store('xls', $localPath);
        $file = $localPath . $slugName . '.xls';
        // Get root directory contents...
        $groupFolder = $report->report_group_id . "_REPORTS_" . $report->from->format('Y-m-d') . "-" . $report->to->format('Y-m-d');
        $contents = collect(Storage::cloud()->listContents('1R53ZQ8dXZvb4QEdoyKsBOd1Gj_rwiAUb', false))->firstWhere('filename', $groupFolder);

        if (!$contents) {
            \Storage::cloud()->makeDirectory('1R53ZQ8dXZvb4QEdoyKsBOd1Gj_rwiAUb/' . $groupFolder);
        }

        $contents = collect(Storage::cloud()->listContents('1R53ZQ8dXZvb4QEdoyKsBOd1Gj_rwiAUb', false))->firstWhere('filename', $groupFolder);
        \Storage::cloud()->put($contents['path'] . '/' . $slugName . '.xls', file_get_contents($file));
        unlink($file);
        $report->download_url = \Storage::cloud()->url($contents['path'] . '/' . $slugName . '.xls');
        $report->total = $orders->count();
        $report->formed_at = now();
        $report->status = 1;
        $report->save();

        return $report;
    }


    public function sendReport($id)
    {
        $report = MedcenterReport::query()->findOrFail($id);
        (new MedcenterReportJob($report))->handle();
        return $report;
    }

    public function saveReport($id, Request $request)
    {
        $report = MedcenterReport::query()->findOrFail($id);
        $data = $request->all();
        $report->fill($data);
        $report->save();
        return $report;
    }
}
