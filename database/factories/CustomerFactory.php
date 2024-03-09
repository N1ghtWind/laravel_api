<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // $table->string('name');
        // $table->enum('type', ['I', 'B']); //individual or business
        // $table->string('email');
        // $table->string('phone');
        // $table->string('address');
        // $table->string('city');
        // $table->string('country');
        // $table->string('zip');

        $type = fake()->randomElement(['I', 'B']);
        $name = $type == 'I' ? fake()->name() : fake()->company();

        return [
            'type' => $type,
            'email' => fake()->safeEmail(),
            'name' => $name,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
        ];
    }
}
