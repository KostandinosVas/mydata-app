<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'vat_number' => fake()->unique()->numerify('#########'),
            'tax_office' => 'Α\' Ηρακλείου',
            'street' => fake()->streetName(),
            'street_number' => (string) fake()->buildingNumber(),
            'postal_code' => fake()->numerify('#####'),
            'city' => fake()->city(),
            'country' => 'GR',
        ];
    }
}
