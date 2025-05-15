<div>
    <form wire:submit.prevent="submit" class="mb-6">
        <input wire:model.defer="name" type="text" placeholder="Название" class="form-control mb-2">
        @error('name') <div class="text-red-600">{{ $message }}</div> @enderror

        <textarea wire:model.defer="description" placeholder="Описание" class="form-control mb-2"></textarea>
        @error('description') <div class="text-red-600">{{ $message }}</div> @enderror

        <button class="btn btn-success">{{ $editId ? 'Обновить' : 'Добавить' }}</button>
        @if($editId)
            <button type="button" wire:click="$reset(['name','description','editId'])" class="btn btn-link">Отмена</button>
        @endif
    </form>

    <table class="table table-bordered w-full">
        <thead>
        <tr>
            <th>ID</th><th>Название</th><th>Описание</th><th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->description }}</td>
                <td>
                    <button wire:click="edit({{ $c->id }})" class="btn btn-sm btn-secondary">✎</button>
                    <button wire:click="delete({{ $c->id }})" class="btn btn-sm btn-danger">🗑</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
