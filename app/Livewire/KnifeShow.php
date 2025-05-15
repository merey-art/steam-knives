<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Knife;

class KnifeShow extends Component
{
    public Knife $knife;

    public function mount(Knife $knife): void
    {
        $this->knife = $knife;
    }

    public function addToCart(): void
    {
        // диспатчим событие, которое ловит CartManager
        $this->dispatch('add', knifeId: $this->knife->id);
    }

    public function render()
    {
        return view('livewire.knife-show');
    }
}
