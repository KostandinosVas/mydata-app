<?php

namespace Database\Factories;

use App\Enums\InvoiceType;
use App\Models\Company;
use App\Models\InvoiceSeries;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceSeries>
 */
class InvoiceSeriesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'invoice_type' => InvoiceType::SalesInvoice,
            'code' => strtoupper(fake()->unique()->lexify('???')), // π.χ. "QXA"
            'branch' => 0,
            'is_active' => true,
        ];
    }
}
