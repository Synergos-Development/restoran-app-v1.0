<?php

namespace Database\Factories;

use App\Models\RestaurantTable;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
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

            'customer_name' => fake()->name(),

            'customer_phone' => fake()->numerify('08##########'),

            'booking_date' => fake()->dateTimeBetween('now', '+7 days'),

            'guest_count' => fake()->numberBetween(1, 8),

            'status' => fake()->randomElement([
                'pending',
                'confirmed',
            ]),
        ];
    }
}
