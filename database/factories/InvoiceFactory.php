<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['B', 'P', 'V']);


        return [
            'customer_id' => CustomerFactory::new(),
            'amount' => fake()->numberBetween(100, 1000),
            'status' => $status,
            'billed_date' => fake()->date(),
            'paid_date' => $status == 'P' ? fake()->date() : null,
        ];
    }
}
