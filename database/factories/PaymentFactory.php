<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()?->id,

            'payment_method' => fake()->randomElement([
                'cash',
                'qris',
                'card',
            ]),

            'amount' => fake()->numberBetween(
                25000,
                300000
            ),

            'status' => fake()->randomElement([
                'paid',
                'pending',
            ]),

            'paid_at' => now(),
        ];
    }
}
