<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use Livewire\Livewire;
use App\Livewire\OrderManager;

class OrderManagerTest extends TestCase
{
    public function test_can_filter_by_status()
    {
        Order::factory()->create(['status'=>'pending']);
        Order::factory()->create(['status'=>'paid']);

        Livewire::test(OrderManager::class)
            ->set('filterStatus', 'paid')
            ->assertDontSee('pending')
            ->assertSee('paid');
    }

    public function test_can_search_by_id_and_user()
    {
        $orderA = Order::factory()->create(['status'=>'pending']);
        $orderB = Order::factory()->create(['status'=>'pending']);

        Livewire::test(OrderManager::class)
            ->set('search', $orderA->id)
            ->assertSee((string)$orderA->id)
            ->assertDontSee((string)$orderB->id);
    }
}
