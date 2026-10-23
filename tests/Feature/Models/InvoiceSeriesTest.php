<?php

use App\Enums\InvoiceType;
use App\Models\Company;
use App\Models\InvoiceSeries;
use Illuminate\Database\UniqueConstraintViolationException;

test('a new series starts at zero and reads its type as an enum', function () {
    $series = InvoiceSeries::factory()->create(['invoice_type' => InvoiceType::RetailReceipt]);

    expect($series->fresh()->last_number)->toBe(0)
        ->and($series->fresh()->invoice_type)->toBe(InvoiceType::RetailReceipt);
});

test('the same code cannot exist twice in the same branch of a company', function () {
    $company = Company::factory()->create();
    InvoiceSeries::factory()->for($company)->create(['code' => 'A', 'branch' => 0]);

    expect(fn () => InvoiceSeries::factory()->for($company)->create(['code' => 'A', 'branch' => 0]))
        ->toThrow(UniqueConstraintViolationException::class);
});

test('the same code can exist in a different branch', function () {
    $company = Company::factory()->create();
    InvoiceSeries::factory()->for($company)->create(['code' => 'A', 'branch' => 0]);
    InvoiceSeries::factory()->for($company)->create(['code' => 'A', 'branch' => 1]);

    expect($company->invoiceSeries)->toHaveCount(2);
});
