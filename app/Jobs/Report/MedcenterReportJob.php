<?php

namespace App\Jobs\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MedcenterReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $report = $this->report;
        Mail::send('mail.reports.medcenter', ['report' => $this->report], function ($m) use ($report) {
            $m->to($report->email, $report->medcenter->name)->subject('Сверка посещений');
            if ($report->email2)
                $m->to($report->email2, $report->medcenter->name)->subject('Сверка посещений');
        });
        $report->sent_at = now();
        $report->status = 2;
        $report->save();
    }
}
