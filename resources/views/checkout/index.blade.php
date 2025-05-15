<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Оформление заказа</h2>
    </x-slot>

    <div class="container mx-auto py-6">
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        @if($knives->isEmpty())
            <p>Корзина пуста.</p>
        @else
            <table class="table table-bordered w-full mb-4">
                <thead>
                <tr><th>Нож</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr>
                </thead>
                <tbody>
                @foreach($knives as $knife)
                    <tr>
                        <td>{{ $knife->name }}</td>
                        <td>{{ $items[$knife->id] }}</td>
                        <td>{{ number_format($knife->price,2) }} ₸</td>
                        <td>{{ number_format($knife->price * $items[$knife->id],2) }} ₸</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <p class="mb-4"><strong>Итого: {{ number_format($total,2) }} ₸</strong></p>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <button class="btn btn-primary">Подтвердить заказ</button>
            </form>
        @endif
    </div>
</x-app-layout>
