<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Knife;
use App\Models\Category;

class KnifeManager extends Component
{
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $editId = null;

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.knife-manager', [
            'knives'     => Knife::with('category')->orderByDesc('id')->get(),
            'categories' => Category::all(),
        ]);
    }

    public function submit()
    {
        $data = $this->validate();

        if ($this->editId) {
            Knife::find($this->editId)->update($data);
        } else {
            Knife::create($data);
        }

        $this->reset(['category_id','name','description','price','stock','editId']);
    }

    public function edit($id)
    {
        $knife            = Knife::findOrFail($id);
        $this->editId     = $knife->id;
        $this->category_id= $knife->category_id;
        $this->name       = $knife->name;
        $this->description= $knife->description;
        $this->price      = $knife->price;
        $this->stock      = $knife->stock;
    }

    public function delete($id)
    {
        Knife::findOrFail($id)->delete();
        $this->reset(['category_id','name','description','price','stock','editId']);
    }
    public function addToCart(int $knifeId)
    {
        // эмитим событие именно в CartManager
        $this->dispatch('cart-manager', 'add', $knifeId);
    }

    public function removeFromCart(int $knifeId)
    {
        $this->dispatch('cart-manager', 'remove', $knifeId);
    }
}
