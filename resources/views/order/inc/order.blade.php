<div class="relative overflow-x-auto">
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
                    Retry
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $order->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $order->goods_id }}
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
                    @if ($order->status == 'success')
                        <x-primary-button disabled>Succeed</x-primary-button>
                    @else
                        <a href="{{ route('orders.retry', $order->id) }}">
                            <x-primary-button>Retry</x-primary-button>
                        </a>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
