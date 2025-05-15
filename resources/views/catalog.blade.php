<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Каталог ножей
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        {{-- CRUD и кнопки «Добавить в корзину» из KnifeManager --}}
        <livewire:knife-manager />

        {{-- Компонент корзины --}}
        <livewire:cart-manager />
    </div>
</x-app-layout>
