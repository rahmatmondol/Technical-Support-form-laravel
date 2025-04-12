<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => fake()->unique()->regexify('[0-9]{10}'),
            'service_submission_date' => fake()->optional()->date(),
            'customer_name' => fake()->optional()->name(),
            'address_line_1' => fake()->optional()->streetAddress(),
            'address_city' => fake()->optional()->city(),
            'address_country' => fake()->optional()->country(),
            'electronic_account_name' => fake()->optional()->name(),
            'type' => fake()->optional()->word(),
            'agreed_to_terms' => fake()->optional()->randomElement(['yes', 'I agreed through WhatsApp']),
            'phone_number' => fake()->optional()->phoneNumber(),
            'amount_previously_paid' => fake()->optional()->randomFloat(2, 0, 10000),
            'electronic_signature' => fake()->optional()->name(),
            'comments' => fake()->optional()->paragraph(),
        ];
    }
}
