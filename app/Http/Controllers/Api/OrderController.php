<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Jobs\CODJob;
use App\Jobs\CartJob;
use App\Models\Order;
use App\Jobs\CheckoutJob;
use App\Jobs\PlaceOrderJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all()->toArray();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order;
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
        return $request;
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

    public function retry(Order $order)
    {
        if ($order->status == 'success') {
            return response()->json([
                "success" => false,
                "message" => "Order has been already placed."
            ]);
        } else {
            Bus::chain([
                new CartJob($order),
                new CheckoutJob($order),
                new PlaceOrderJob($order),
                new CODJob($order),
            ])->catch(function (Throwable $e) use ($order) {
                log_res($e->getMessage());
                $order->status = "Failed :: " . $e->getMessage();
                $order->save();
            })->dispatch();
            return response()->json([
                "success" => true,
                "message" => "Order has been added to queue."
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Order has been added to queue."
        ]);
    }
}
