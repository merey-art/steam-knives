<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Связанная модель
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Определение значений по умолчанию для модели.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'    => null,
            'total'      => $this->faker->randomFloat(2, 100, 1000),
            'status'     => $this->faker->randomElement(['pending','paid','shipped']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
