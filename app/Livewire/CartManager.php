<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Knife;

class CartManager extends Component
{
    public $items = [];
    protected $listeners = ['add','remove'];

    public function mount()
    {
        $this->items = session('cart', []);
    }

    public function add($knifeId)
    {
        $this->items[$knifeId] = ($this->items[$knifeId] ?? 0) + 1;
        session(['cart' => $this->items]);
    }

    public function remove($knifeId)
    {
        if (! isset($this->items[$knifeId])) return;
        if ($this->items[$knifeId] > 1) {
            $this->items[$knifeId]--;
        } else {
            unset($this->items[$knifeId]);
        }
        session(['cart' => $this->items]);
    }

    public function render()
    {
        $knives = Knife::whereIn('id', array_keys($this->items))->get();
        return view('livewire.cart-manager', compact('knives'));
    }
}
