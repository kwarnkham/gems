<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreOrder>
 */
class PreOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => 'ring',
            'price' => fake()->numberBetween(10000, 100000),
            'shape' => 'Round Brilliant',
            'color' => 'D',
            'carat' => 0.5,
            'clarity' => 'FL',
            'cut' => 'excellent',
        ];
    }
}
