<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Utility\SheinOrderUtility;

class CartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $order;

    public $tries = 3;

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
        $status = 'processing';
        update_orders($order, $status);

        $product = json_decode($client->get_product_info($order->goods_id));

        $cat_id = $product->info->cat_id;
        $description = $product->info->goods_name . ' - ' . $order->variant;
        update_orders($order, cat_id: $cat_id, description: $description);

        $response = $client->addToCart($order->goods_id, $order->sku);
        log_res($response, "Add to cart | {$order->goods_id} | {$order->sku}");
        $cart = json_decode($client->get_cart());
        if ($cart->code != 0) {
            $status = 'Failed: cart response code mismatch';
            update_orders($order, $status);
            $this->fail();
            return;
        }
        $shops = [];
        foreach ($cart->info->mallCartInfo->mallCarts as $key => $value) {
            if ($value->type == 1) {
                $shops = $value->shops;
                break;
            }
        }
        $skus = $order->combined_order->orders->pluck('sku');
        foreach ($shops as $key => $shop) {
            foreach ($shop->contentData as $key => $value) {
                foreach ($value->productLineInfoList as $key => $value) {
                    if ($value->is_checked == 1 && !in_array($value->product->sku_code, $skus->toArray())) {
                        $res = $client->change_cart_item_status($value->id, 2);
                        log_res($res->getContents(), 'Unselect other cart Items');
                    }
                    if ($value->product->sku_code == $order->sku) {
                        if ($value->is_checked == 0) {
                            $res = $client->change_cart_item_status($value->id, 1);
                            log_res($res->getContents(), 'Select cart Items');
                        }
                        if ($value->quantity != $order->quantity) {
                            $res = $client->change_cart_item_quantity($value->id, $order->quantity);
                            log_res($res->getContents(), 'Change cart item quantity');
                        }
                    }
                }
            }
        }

    }

}
