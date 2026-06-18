<?php

namespace Database\Factories;

use App\Models\RestaurantTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RestaurantTable>
 */
class RestaurantTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_number' => 'M'.fake()->unique()->numberBetween(1, 20),

            'capacity' => fake()->randomElement([
                2,
                4,
                6,
                8,
            ]),

            'status' => 'available',
        ];
    }
}
