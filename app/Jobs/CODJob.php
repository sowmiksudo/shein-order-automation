<?php

namespace App\Jobs;

use App\Models\Order;
use App\Utility\SheinOrderUtility;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CODJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $order;
    public $tries = 5;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;
        $order = $order->fresh();
        $client = new SheinOrderUtility;
        $bill = $order->billno;

        $res = $client->cod_confirm($bill);

        $order_sum = json_decode($client->order_sum($bill));
        $amount = $order_sum->info->totalPrice->usdAmount;
        $receipt = json_encode($order_sum->info);
        update_orders($order, null, $bill, $amount, $receipt);

        log_res(json_encode($order_sum), 'Order receipt');

        if(!isset($order_sum->info->payOrder)){
            $status = 'Failed: Could not confirm Cash on delivery | ' . json_decode($order_sum)->msg;
            update_orders($order, $status);
            $this->fail();
            return;
        }

        log_res($res->getContents(), 'Confirm COD');

        $status = 'success';
        update_orders($order, $status);
    }
}
