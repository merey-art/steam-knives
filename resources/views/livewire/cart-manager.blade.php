<div>
    <h2>Корзина</h2>
    @if(count($items))
        <table class="table">
            <tr><th>Нож</th><th>Кол-во</th><th>Цена</th><th>Итого</th><th></th></tr>
            @foreach($knives as $knife)
                <tr>
                    <td>{{ $knife->name }}</td>
                    <td>{{ $items[$knife->id] }}</td>
                    <td>{{ number_format($knife->price,2) }}</td>
                    <td>{{ number_format($knife->price * $items[$knife->id],2) }}</td>
                    <td><button wire:click="remove({{ $knife->id }})" class="btn btn-sm btn-danger">×</button></td>
                </tr>
            @endforeach
        </table>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Оформить заказ</a>
    @else
        <p>Корзина пуста.</p>
    @endif
</div>
