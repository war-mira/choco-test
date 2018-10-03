<?php

namespace App\Mail;

use App\Order;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;

class MedcenterReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        Storage::disk('temp')->put('.txt', 'OLOLOLO');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $filename = base_path('storage/temp/' . str_random(16) . ".xlsx");
        $orders = Order::whereBetween('created_at', [now()->subMonth(), now()])
            ->get();
        Excel::create("EXCEL", function ($excel) use ($orders) {
            /** @var Excel $excel */
            $excel->sheet('Отчет', function ($sheet) use ($orders) {
                /** @var LaravelExcelWorksheet $sheet */
                $sheet->loadView('admin.export.orders', compact('orders'));
            });
        })->store('xls', base_path('storage/temp/' . $filename));

        \Storage::cloud()->put('text.xlsx', file_get_contents($filename));

        return $this->view('mail.reports.medcenter');
    }
}
