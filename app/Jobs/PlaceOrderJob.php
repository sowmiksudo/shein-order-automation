<?php

namespace App\Jobs;

use App\Models\Order;
use App\Utility\SheinOrderUtility;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PlaceOrderJob implements ShouldQueue
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
        $res = $client->place_order(4727);
        $res = json_decode($res);
        log_res(json_encode($res), 'Place Order');

        if($res->code != "0"){
            $order->status = 'Failed: Could not place order | ' . $res->msg;
            $order->save();
            $this->fail();
            return;
        }

        $bill = $res->info->order->billno;
        $amount = $res->info->totalPrice->amount ?? null;
        $order->billno = $bill;
        $order->price = $amount;
        $order->save();

    }
}
