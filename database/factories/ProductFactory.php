<?php

namespace Database\Factories;

use App\Enums\VatCategory;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'unit_price' => fake()->randomFloat(2, 1, 500),
            'vat_category' => VatCategory::Vat24,
        ];
    }
}
