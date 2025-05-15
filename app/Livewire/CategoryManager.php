<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{
    public $name;
    public $description;
    public $editId = null;

    protected $rules = [
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.category-manager', [
            'categories' => Category::orderByDesc('id')->get(),
        ]);
    }

    public function submit()
    {
        $data = $this->validate();

        if ($this->editId) {
            Category::find($this->editId)->update($data);
        } else {
            Category::create($data);
        }

        $this->reset(['name', 'description', 'editId']);
    }

    public function edit($id)
    {
        $category         = Category::findOrFail($id);
        $this->editId     = $category->id;
        $this->name       = $category->name;
        $this->description= $category->description;
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        $this->reset(['name', 'description', 'editId']);
    }
}
