<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Заказ №{{ $order->id }} создан</h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <p>Спасибо! Ваш заказ успешно оформлен.</p>
        <p>Сумма: <strong>{{ number_format($order->total,2) }} ₸</strong></p>
        <a href="{{ route('catalog') }}" class="btn btn-link">Вернуться в каталог</a>
    </div>
</x-app-layout>
