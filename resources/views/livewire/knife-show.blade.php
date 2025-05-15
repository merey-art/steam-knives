<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $knife->name }}</h1>
    <p class="mb-4">{{ $knife->description }}</p>
    <p class="mb-2">Цена: <strong>{{ number_format($knife->price,2) }} ₸</strong></p>
    <p class="mb-4">В наличии: <strong>{{ $knife->stock }}</strong> шт.</p>
    <button wire:click="addToCart" class="btn btn-primary">Добавить в корзину</button>
</div>
