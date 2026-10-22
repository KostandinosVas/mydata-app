<?php

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\UniqueConstraintViolationException;

test('a customer belongs to a company', function () {
    $company = Company::factory()->create();

    $customer = Customer::factory()->for($company)->create();

    expect($customer->company->is($company))->toBeTrue()
        ->and($company->customers)->toHaveCount(1);
});

test('the same VAT number cannot exist twice in the same company', function () {
    $company = Company::factory()->create();
    Customer::factory()->for($company)->create(['vat_number' => '094000000']);

    expect(fn () => Customer::factory()->for($company)->create(['vat_number' => '094000000']))
        ->toThrow(UniqueConstraintViolationException::class);
});

test('the same VAT number can exist in different companies', function () {
    Customer::factory()->for(Company::factory())->create(['vat_number' => '094000000']);
    Customer::factory()->for(Company::factory())->create(['vat_number' => '094000000']);

    expect(Customer::where('vat_number', '094000000')->count())->toBe(2);
});

test('many customers without a VAT number can exist in the same company', function () {
    $company = Company::factory()->create();

    Customer::factory()->for($company)->count(3)->create(['vat_number' => null]);

    expect($company->customers()->whereNull('vat_number')->count())->toBe(3);
});
