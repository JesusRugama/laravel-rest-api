<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('???###'),
            'title' => $this->faker->words(3, true),
            'price' => $this->faker->randomNumber(4),
            'description' => $this->faker->paragraph(),
            'published' => $this->faker->boolean,
        ];
    }
}
