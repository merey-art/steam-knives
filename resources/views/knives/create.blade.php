<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Новый нож
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <form action="{{ route('knives.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="category_id" class="form-label">Категория</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">— выбрать —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" name="price" id="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="stock" class="form-label">Склад (шт.)</label>
                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required>
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <button class="btn btn-success mt-4">Сохранить</button>
            <a href="{{ route('knives.index') }}" class="btn btn-link mt-4">Отмена</a>
        </form>
    </div>
</x-app-layout>
