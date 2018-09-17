<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Medcenter;
use App\Order;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use PHPExcel_Worksheet_Drawing;
use Illuminate\Support\Facades\Redis;
use PhpParser\Comment\Doc;

class ReportController extends Controller
{
    public function daily(Request $request)
    {
        $start = $request->input('start', false);
        $end = $request->input('end', false);

        $start = $start ? Carbon::createFromFormat('Y-m-d H:i', $start) : Carbon::yesterday()->setTime(19, 0);
        $end = $end ? Carbon::createFromFormat('Y-m-d H:i', $end) : Carbon::today()->setTime(19, 0);

        $orders = Order::query()->whereBetween('created_at', [$start, $end]);

        $total = $orders->count();
        $fromInternet = (clone $orders)->where('from_internet', 1)->count();

        $statuses = [];
        foreach (Order::STATUS as $key => $status) {
            $statuses[$key]['name'] = $status['name'];
            if (isset($status['children']))
                $statuses[$key]['ids'] = array_merge(array_pluck($status['children'], 'id'), [$status['id']]);
            else
                $statuses[$key]['ids'] = [$status['id']];
        }


        $reports = [];
        $operators = User::getOperators()->map(function ($operator) {
            return ['id' => $operator->id, 'name' => $operator->name];
        })->push(['id' => null, 'name' => 'Без оператора'])->push(['id' => false, 'name' => 'Всего']);
        foreach ($operators as $operator) {

            if ($operator['id'] === false)
                $operatorOrders = $orders->get();
            else
                $operatorOrders = (clone $orders)->where('operator_id', $operator['id'])->get();

            $statusOrdersCount = [];
            foreach ($statuses as $key => $status) {
                $statusOrdersCount[$key] = $operatorOrders->whereIn('status', $status['ids'])->count();
            }
            $reports[] = [
                'id' => $operator['id'],
                'name' => $operator['name'],
                'orders' => $statusOrdersCount
            ];
        }



        return view('admin.reports.order')
            ->with('activeLink', 'report.daily')
            ->with('start', $start)
            ->with('end', $end)
            ->with('total', $total)
            ->with('fromInternet', $fromInternet)
            ->with('statuses', $statuses)
            ->with('reports', $reports);
    }

    public function clinic_order($StartDateTime = null, $EndDateTime = null, $MedcenterID = null)
    {
        $StartDateTime = $StartDateTime ?? Carbon::today()->toDateString();
        $EndDateTime = $EndDateTime ?? Carbon::tomorrow()->toDateString();
        $startdate = strtotime($StartDateTime);
        $enddate = strtotime($EndDateTime);

        $Medcenter = Medcenter::find($MedcenterID) ?? Medcenter::all()->first();
        $MedcentersAll = Medcenter::orderBy('name')->whereStatus(1)->get();
        $Orders = Order::query()->whereBetween('event_date', [$startdate, $enddate])
            ->where('med_id', $MedcenterID)
            ->whereIn('status', [1, 2, 3])
            ->orderBy('status')
            ->get();
        if (empty($Orders)) {
            $Orders = [];
        }
        return view('admin.reports.clinic')
            ->with('activeLink', 'report.medcenter')
            ->with('Orders', $Orders)
            ->with('Medcenter', $Medcenter)
            //->with('price', $Medcenter->price)
            ->with('comission', $Medcenter->commission)
            ->with('Medcenters', $MedcentersAll);
    }

    public function clinic_excel($StartDateTime = null, $EndDateTime = null, $MedcenterID = null)
    {
        $StartDateTime = $StartDateTime ?? Carbon::today()->toDateString();
        $EndDateTime = $EndDateTime ?? Carbon::tomorrow()->toDateString();
        $startdate = strtotime($StartDateTime);
        $enddate = strtotime($EndDateTime);

        $medcenter = Medcenter::query()->find($MedcenterID) ?? Medcenter::all()->first();
        $orders = Order::query()
            ->whereBetween('event_date', [$startdate, $enddate])
            ->where('med_id', $MedcenterID)
            ->whereIn('status', [1, 2, 3])
            ->orderBy('status')
            ->get();
        if (empty($orders)) {
            $orders = [];
        }

        Excel::create($medcenter->name, function ($excel) use ($orders, $medcenter, $StartDateTime, $EndDateTime) {
            /** @var Excel $excel */
            $args = ['Orders' => $orders, 'Medcenter' => $medcenter, 'start' => $StartDateTime, 'end' => $EndDateTime];

            $excel->sheet('Отчет', function ($sheet) use ($args) {

                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.reports.export.clinic', $args);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/idoc_logo.png')); //your image path
                $objDrawing->setCoordinates('F2');
                $objDrawing->setWorksheet($sheet);

            });
        })->export('xls');
    }

    public function doctor_order($StartDateTime = null, $EndDateTime = null, $DoctorID = null)
    {
        $StartDateTime = $StartDateTime ?? Carbon::today()->toDateString();
        $EndDateTime = $EndDateTime ?? Carbon::tomorrow()->toDateString();

        $startdate = strtotime($StartDateTime);
        $enddate = strtotime($EndDateTime);
        $Doctor = Doctor::find($DoctorID) ?? Doctor::all()->first();
        $DoctorAll = Doctor::whereStatus(1)->orderBy('lastname')->get();
        $Orders = Order::whereBetween('event_date', [$startdate, $enddate])->where('doc_id', $DoctorID)->where('status', [1, 2])->get();
        if (empty($Orders)) {
            $Orders = [];
        }
        return view('admin.reports.doctor')
            ->with('activeLink', 'report.doctor')
            ->with('Orders', $Orders)
            ->with('Doctor', $Doctor)
            ->with('comission', 0)
            ->with('Doctors', $DoctorAll);
    }

    public function monthForm()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        return view('admin.reports.month', compact('year', 'month'));
    }

    public function reportForMonth(Request $request)
    {
        if ($request->has('operatorForMonth'))
            return $this->operatorForMonth($request);
        else if ($request->has('medcenterForMonth'))
            return $this->medcenterForMonth($request);
        return response("Bad request", 400);
    }

    public function operatorForMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $status = $request->input('status', []);
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $dates = collect([]);

        for ($currDay = 1; $currDay <= $daysInMonth; $currDay++) {
            $dayBegin = Carbon::create($year, $month, $currDay)->startOfDay();
            $dayEnd = $dayBegin->copy()->endOfDay();
            $dates->push([
                'day' => $dayBegin->format('m.d'),
                'begin' => $dayBegin->timestamp,
                'end' => $dayEnd->timestamp
            ]);
        }
        $operators = User::getOperators();
        $args = compact('operators', 'dates', 'status');

        Excel::create('Заявки по операторам ' . $year . "-" . $month, function ($excel) use ($args) {

            $excel->sheet('Отчет', function ($sheet) use ($args) {

                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.export.orders-operator', $args);

            });
        })->export('xls');
    }

    public function medcenterForMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $status = $request->input('status', []);
        $dates = collect([]);
        for ($currDay = 1; $currDay <= $daysInMonth; $currDay++) {
            $dayBegin = Carbon::create($year, $month, $currDay)->startOfDay();
            $dayEnd = $dayBegin->copy()->endOfDay();
            $dates->push([
                'day' => $dayBegin->format('m.d'),
                'begin' => $dayBegin->timestamp,
                'end' => $dayEnd->timestamp
            ]);
        }
        $medcenters = \App\Medcenter::where('id', 0)->get()->merge(\App\Medcenter::orderBy('name')->where('status', 1)->get());
        $args = compact('medcenters', 'dates', 'status');

        Excel::create('Заявки по медцентрам ' . $year . "-" . $month, function ($excel) use ($args) {

            $excel->sheet('Отчет', function ($sheet) use ($args) {

                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.export.orders-medcenter', $args);

            });
        })->export('xls');
    }

    public function doctorsClicks(Request $request)
    {
        $dateFrom = new \DateTime($request->date_from);
        $dateTo = new \DateTime($request->date_to);
        $city = $request->city;
        $doctorsClicksRows = Redis::keys('doctor_city_date:*:'.$city.':*daily:clicks');
        $doctors = collect();
        foreach ($doctorsClicksRows as $row)
        {
            $date = explode(':', $row)[3];
            if($date > $dateFrom->setTime(0,0)->getTimestamp() && $date < $dateTo->setTime(23, 59)->getTimestamp()){
                $set = Redis::ZRANGE($row, 0, -1);
                foreach ($set as $setRow){
                    $data = json_decode($setRow, true)['doctor'];
                    $data['count'] =  Redis::ZSCORE($row, $setRow);
                    $doctors->push($data);
                }
            }
            $doctors = $doctors->sortByDesc('count');
        }

        return view('admin.reports.doctors-clicks.list', compact('doctors'));

    }
}
