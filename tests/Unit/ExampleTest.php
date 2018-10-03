<?php

namespace Tests\Unit;

use App\Helpers\FormatHelper;
use App\Jobs\GaEcommerceJob;
use App\Order;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        (new GaEcommerceJob())->handle();
    }

    private function getUniquePhones($start, $end)
    {
        $orders = Order::whereBetween('created_at', [$start, $end])->whereIn('status', [1, 2])->get()->pluck('client_info');
        $phones = $orders->map(function ($client) {
            return FormatHelper::phone($client['phone']);
        });
        return $phones;
    }
}
