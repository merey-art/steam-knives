<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderManager extends Component
{
    use WithPagination;
    use HasFactory;

    public string $filterStatus = '';
    public string $search       = '';
    public array  $expanded     = [];

    protected $updatesQueryString = ['filterStatus','search'];
    protected $paginationTheme    = 'bootstrap';

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function toggle(int $orderId): void
    {
        if (in_array($orderId, $this->expanded)) {
            $this->expanded = array_diff($this->expanded, [$orderId]);
        } else {
            $this->expanded[] = $orderId;
        }
    }

    public function updateStatus(int $orderId, string $newStatus): void
    {
        Order::find($orderId)->update(['status' => $newStatus]);
        // оставляем на той же странице, данные подтянутся из запроса
    }

    public function render()
    {
        $query = Order::with('items.knife','user')
            ->when($this->filterStatus, fn($q)=> $q->where('status',$this->filterStatus))
            ->when($this->search, function($q){
                $term = "%{$this->search}%";
                $q->where('id','like',$term)
                    ->orWhereHas('user', fn($u)=> $u->where('name','like',$term));
            })
            ->orderByDesc('created_at');

        $orders = $query->paginate(10);

        return view('livewire.order-manager', compact('orders'));
    }
}
