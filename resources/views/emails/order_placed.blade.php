@component('mail::message')
    # Спасибо за ваш заказ!

    Номер заказа: **{{ $order->id }}**
    Дата: {{ $order->created_at->format('d.m.Y H:i') }}

    @component('mail::table')
        | Товар       | Кол-во | Цена за шт. | Сумма     |
        |-------------|-------:|-----------:|----------:|
        @foreach($order->items as $item)
            | {{ $item->knife->name }} | {{ $item->quantity }} | {{ number_format($item->price,2) }} ₸ | {{ number_format($item->price * $item->quantity,2) }} ₸ |
        @endforeach
    @endcomponent

    **Итого:** {{ number_format($order->total,2) }} ₸

    Спасибо,
    {{ config('app.name') }}
@endcomponent
