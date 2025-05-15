<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать категорию
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button class="btn btn-primary">Обновить</button>
            <a href="{{ route('categories.index') }}" class="btn btn-link">Отмена</a>
        </form>
    </div>
</x-app-layout>
