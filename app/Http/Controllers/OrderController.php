<?php

namespace App\Http\Controllers;

use Throwable;
use App\Jobs\CartJob;
use App\Models\Order;
use App\Jobs\OrderJob;
use App\Jobs\CheckoutJob;
use App\Jobs\IpLoggerJob;
use Illuminate\Http\Request;
use App\Utility\SheinOrderUtility;
use App\Http\Requests\OrderRequest;
use App\Jobs\PlaceOrderJob;
use Illuminate\Support\Facades\Bus;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $info = (new SheinOrderUtility)->ip_info();
        dispatch(new IpLoggerJob($info));
        return $info;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->only('goods_id', 'sku', 'quantity'));

        Bus::chain([
            new CartJob($order),
            new CheckoutJob($order),
            new PlaceOrderJob($order),
        ])->catch(function(Throwable $e){
            log_res($e->getMessage());
        })->dispatch();
        return response()->json([
            "success"=>true,
            "order" => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
