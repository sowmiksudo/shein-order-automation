<div class="relative overflow-x-auto">
    @if($orders->count() > 0)
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Product ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    BillNo
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Details
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $order->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $order->goods_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->quantity }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->billno }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $order->status }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('order', $order) }}">
                            <x-primary-button>View</x-primary-button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("No orders found") }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
