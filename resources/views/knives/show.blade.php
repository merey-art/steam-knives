<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $knife->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">

        <livewire:knife-show :knife="$knife"/>


        <livewire:cart-manager/>
    </div>
</x-app-layout>
