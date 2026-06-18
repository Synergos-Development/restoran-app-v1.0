<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()?->id,
            'name' => fake()->randomElement([
                'Nasi Goreng',
                'Mie Goreng',
                'Ayam Bakar',
                'Ayam Geprek',
                'Sate Ayam',
                'Es Teh',
                'Jus Alpukat',
                'Kopi Hitam',
            ]).' '.fake()->numberBetween(1, 999),

            'description' => fake()->sentence(),

            'price' => fake()->numberBetween(10000, 75000),

            'image' => null,

            'is_available' => true,
        ];
    }
}
