<table class="table table-bordered w-full">
    <thead>
    <tr>
        <th>ID</th>
        <th>Категория</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Склад</th>
        <th>Действия</th>
        <th>В корзину</th> <!-- новый заголовок -->
    </tr>
    </thead>
    <tbody>
    @foreach($knives as $knife)
        <tr>
            <td>{{ $knife->id }}</td>
            <td>{{ $knife->category->name }}</td>
            <td>{{ $knife->name }}</td>
            <td>{{ number_format($knife->price, 2) }}</td>
            <td>{{ $knife->stock }}</td>
            <td>
                <button wire:click="edit({{ $knife->id }})" class="btn btn-sm btn-secondary">✎</button>

                <button
                    wire:click="$dispatch('remove', { knifeId: {{ $knife->id }} })"
                    class="btn btn-sm btn-warning">
                    –1
                </button>
            </td>
            <td>
                <button
                    wire:click="$dispatch('add', { knifeId: {{ $knife->id }} })"
                    class="btn btn-sm btn-primary">
                    Добавить в корзину
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
