<?php

namespace App\Http\Controllers;

use Throwable;
use App\Jobs\CODJob;
use App\Jobs\CartJob;
use App\Models\Order;
use App\Jobs\CheckoutJob;
use App\Jobs\IpLoggerJob;
use App\Jobs\PlaceOrderJob;
use Illuminate\Http\Request;
use App\Utility\SheinOrderUtility;
use LaravelDaily\Invoices\Invoice;
use App\Http\Requests\OrderRequest;
use App\Models\CombinedOrder;
use Illuminate\Support\Facades\Bus;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index', [
            'orders' => Order::paginate(20)
        ]);
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
        log_res($request);

        $combined_order = new CombinedOrder;

        $combined_order->main_order_id = $request->order_id;
        $combined_order->save();
        $combined_order = $combined_order->fresh();

        foreach ($request->orders as $key => $order) {
            $combined_order->orders()->create($order);
        }

        $jobsArr = [
        ];

        $orders = $combined_order->orders;
        foreach ($orders as $key => $order) {
            array_push($jobsArr, new CartJob($order));
        }

        $jobsArr = array_merge($jobsArr, [
            new CheckoutJob($order),
            new PlaceOrderJob($order),
            new CODJob($order),
        ]);

        Bus::chain($jobsArr)->catch(function (Throwable $e = null) use ($order) {
            log_res($e);
            $order->status = "Failed :: " . $e->getMessage();
            $order->save();
        })->dispatch();
        return response()->json([
            "success" => true,
            "orders" => $orders
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, $id)
    {
        $order = Order::findOrFail($id);
        return view('order.show', [
            'order' => $order
        ]);
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

    public function ip()
    {

        $info = (new SheinOrderUtility)->ip_info();
        dispatch(new IpLoggerJob($info));
        return $info;
    }

    public function retry($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'success') {
            flash('Order has been already placed!')->info();
            return back();
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
            return back();
        }
        flash('Order has been added to the queue for retry.')->success();
        return back();
    }

    public function export(Request $request)
    {
        $orders = '';
        $range = '';
        if ($request->month == 'all') {
            $orders = Order::all();
            $range = 'Till - ' . now();
        } else {
            $orders = Order::select("*")->whereMonth('created_at', now()->month)->get();
            $range = now()->startOfMonth() . ' - ' . now();
        }

        $customer = new Buyer([
            'name'          => 'HASBILAH TECH SDN. BHD',
            'custom_fields' => [
                'account name' => 'Malaysian Products',
                'address' => "Suite 1, Level 5, P.O. Box 38,
                    Menara Dato' Onn, Jalan Tun Ismail,
                    Kuala Lumpur, Malaysia",
            ],
        ]);

        $client = new Party([
            'name'          => 'AI Order',
            'custom_fields' => [
                'product name'      => 'Order Automation',
                'System URL'      => 'malaysianproducts.com.my',
                'Report Range'   => $range
            ],
        ]);

        $items = [];
        foreach ($orders as $order) {
            $item = (new InvoiceItem())
                    ->description($order->description ?? '')
                    ->order_date($order->created_at)
                    ->automation_status($order->status)
                    ->sl(str_pad($order->id,4, '0', STR_PAD_LEFT))
                    ->pricePerUnit($order->price ?? 0);
            array_push($items, $item);
        }

        $invoice = Invoice::make('STATEMENT')
            ->buyer($customer)
            ->seller($client)
            ->status(__('ORDER AUTOMATION'))
            ->addItems($items)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->logo(public_path('img/logo.png'));

        return $invoice->stream();
    }

    public function product(Request $request){
        $client = new SheinOrderUtility;
        return $client->get_product_info($request->id);
    }
}
