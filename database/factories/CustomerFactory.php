<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
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
        return [
            'company_id' => Company::factory(),
            'name' => fake()->company(),
            'vat_number' => fake()->unique()->numerify('#########'),
            'tax_office' => 'Α\' Ηρακλείου',
            'country' => 'GR',
            'street' => fake()->streetName(),
            'street_number' => (string) fake()->buildingNumber(),
            'postal_code' => fake()->numerify('#####'),
            'city' => fake()->city(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->numerify('69########'),
        ];
    }
}
