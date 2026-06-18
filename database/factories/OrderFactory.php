<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Order;
use App\Models\RestaurantTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => RestaurantTable::inRandomOrder()->first()?->id,

            'booking_id' => Booking::inRandomOrder()->first()?->id,

            'order_number' => 'ORD-'.fake()->unique()->numberBetween(
                100000,
                999999
            ),

            'status' => fake()->randomElement([
                'draft',
                'completed',
            ]),

            'total_price' => fake()->numberBetween(
                25000,
                300000
            ),
        ];
    }
}
