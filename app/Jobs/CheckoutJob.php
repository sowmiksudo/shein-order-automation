<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use App\Utility\SheinOrderUtility;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CheckoutJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $order;
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
        $client = new SheinOrderUtility;
        $order = $this->order;
        $res = $client->checkout_cart($order);
        $res2 = $client->checkout_cart_2($order);
        log_res($res->getContents(), 'Checkout Cart 1');
        log_res($res2->getContents(), 'Checkout Cart 2');
        dispatch(new PlaceOrderJob($order));
    }
}
