<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 px-12 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2">
                        <div>
                            <p class="text-2xl">Order <span class="italic">#{{ $order->id }}</span></p>
                            <p class="text-sm">Order status: {{ ucfirst($order->status) }}</p>
                            <p class="text-sm">Bill No: {{ $order->billno }}</p>
                            <p class="text-sm">Total Payable Price:
                                {!! $order->price ?? '<span class="text-xs">NOT AVAILABLE</span>' !!}</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <p class="text-2xl">Shein <span class="italic">#{{ $order->goods_id }}</span></p>
                            <p class="text-sm">Product link: <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="https://malaysianproducts.com.my/shein/product/{{ $order->goods_id }}">Link</a>
                            </p>
                            <p class="text-sm">SKU: {{ $order->sku }}</p>
                            <p class="text-sm">Applied Discounts:
                                {!! $order->discount ?? '<span class="text-xs">NOT AVAILABLE</span>' !!}</p>
                            <p class="text-sm">Product Price:
                                {!! $order->price ?? '<span class="text-xs">NOT AVAILABLE</span>' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('order.inc.order')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
