<?php

namespace App\Jobs;

use App\Callback;
use App\Enums\OrderStatus;
use App\Order;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GaEcommerceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $callbacks = Callback::query()->where('ga_cid', '>', '')->where('ga_complete', 0)->get();
        $callbacks->each(function (Callback $callback) {
            $status = $this->callbackGaRequest($callback);
            if ($status == 200) {
                $callback->update(['ga_complete' => 1]);
            }
        });

        $orders = Order::query()
            ->with(['callback', 'doctor'])
            ->whereIn('status', [OrderStatus::VISIT_SUCCESS, OrderStatus::VISIT_CHECK])
            ->where('ga_complete', 0)
            ->whereHas('callback', function ($callbackQuery) {
                $callbackQuery->where('ga_cid', '>', '');
            })->get();
        $orders->each(function (Order $order) {
            $statusTransaction = $this->orderGaRequest($order);
            $statusItem = $this->orderItemGaRequest($order);
            if ($statusTransaction == 200 && $statusItem == 200) {
                $order->update(['ga_complete' => 1]);
            }
        });

    }

    private function callbackGaRequest(Callback $callback)
    {
        $payload = [
            'v'   => 1,
            'tid' => env('GA_TID', 'UA-44507625-1'),
            'cid' => $callback->ga_cid,
            't'   => 'event',
            'ec'  => 'zayavka',
            'ea'  => 'pustupila'
        ];
        $body = http_build_query($payload);
        $client = new Client();
        $request = $client->request('POST', 'http://www.google-analytics.com/collect', ['body' => $body]);
        return $request->getStatusCode();
    }

    private function orderGaRequest(Order $order)
    {
        $payload = [
            'v'   => 1,
            'tid' => env('GA_TID', 'UA-44507625-1'),
            'cid' => $order['callback']['ga_cid'],
            't'   => 'transaction',
            'ti'  => $order->id,
            'tr'  => $order->doctor->commission
        ];
        $body = http_build_query($payload);
        $client = new Client();
        $request = $client->request('POST', 'http://www.google-analytics.com/collect', ['body' => $body]);
        return $request->getStatusCode();
    }

    private function orderItemGaRequest(Order $order)
    {
        $payload = [
            'v'   => 1,
            'tid' => env('GA_TID', 'UA-44507625-1'),
            'cid' => $order['callback']['ga_cid'],
            't'   => 'item',
            'ti'  => $order->id,
            'in'  => $order->doctor->name,
            'ip'  => $order->doctor->price
        ];
        $body = http_build_query($payload);
        $client = new Client();
        $request = $client->request('POST', 'http://www.google-analytics.com/collect', ['body' => $body]);
        return $request->getStatusCode();
    }
}
