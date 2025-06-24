<?php

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
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU###')),
            'quantity' => $this->faker->numberBetween(10, 500),
            'cost_price' => $this->faker->numberBetween(1000, 100000),
            'selling_price' => $this->faker->numberBetween(1000, 150000),
            'status'=>'A',
            'created_by'=>1
        ];
    }
}
