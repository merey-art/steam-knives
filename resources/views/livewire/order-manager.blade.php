<div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-6">Управление заказами</h1>

    <div class="mb-6 flex flex-wrap items-center gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Фильтр по статусу:</label>
            <select wire:model="filterStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent">
                <option value="">Все</option>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
                <option value="shipped">Shipped</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Поиск:</label>
            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="ID или имя клиента"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-accent focus:border-accent"
            />
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Клиент</th>
                <th class="px-4 py-2 text-left">Сумма</th>
                <th class="px-4 py-2 text-left">Статус</th>
                <th class="px-4 py-2 text-left">Дата</th>
                <th class="px-4 py-2 text-left">Действия</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <button wire:click="toggle({{ $order->id }})" class="text-gray-600 hover:text-accent focus:outline-none">
                            {{ in_array($order->id, $expanded) ? '–' : '+' }}
                        </button>
                    </td>
                    <td class="px-4 py-3">{{ $order->id }}</td>
                    <td class="px-4 py-3">{{ optional($order->user)->name ?? 'Гость' }}</td>
                    <td class="px-4 py-3">{{ number_format($order->total,2) }} ₸</td>
                    <td class="px-4 py-3">{{ ucfirst($order->status) }}</td>
                    <td class="px-4 py-3">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td class="px-4 py-3 space-x-1">
                        @foreach(['pending','paid','shipped'] as $status)
                            @if($status !== $order->status)
                                <button
                                    wire:click="updateStatus({{ $order->id }}, '{{ $status }}')"
                                    class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                                    → {{ ucfirst($status) }}
                                </button>
                            @endif
                        @endforeach
                    </td>
                </tr>

                @if(in_array($order->id, $expanded))
                    <tr class="bg-gray-50">
                        <td></td>
                        <td colspan="6" class="px-4 py-4">
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Нож</th>
                                        <th class="px-4 py-2 text-right">Кол-во</th>
                                        <th class="px-4 py-2 text-right">Цена</th>
                                        <th class="px-4 py-2 text-right">Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($order->items as $item)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-4 py-2">{{ $item->knife->name }}</td>
                                            <td class="px-4 py-2 text-right">{{ $item->quantity }}</td>
                                            <td class="px-4 py-2 text-right">{{ number_format($item->price,2) }} ₸</td>
                                            <td class="px-4 py-2 text-right">{{ number_format($item->price * $item->quantity,2) }} ₸</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $orders->links() }}
    </div>
</div>
