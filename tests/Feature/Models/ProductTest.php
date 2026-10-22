<?php

use App\Enums\VatCategory;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

test('a product belongs to a company', function () {
    $company = Company::factory()->create();

    $product = Product::factory()->for($company)->create();

    expect($product->company->is($company))->toBeTrue()
        ->and($company->products)->toHaveCount(1);
});

test('vat category is stored as the AADE code and read back as an enum', function () {
    $product = Product::factory()->create(['vat_category' => VatCategory::Vat13]);

    $rawValue = DB::table('products')->where('id', $product->id)->value('vat_category');

    expect($rawValue)->toBe(2)
        ->and($product->fresh()->vat_category)->toBe(VatCategory::Vat13)
        ->and($product->fresh()->vat_category->rate())->toBe(13);
});

test('unit price keeps exactly two decimals', function () {
    $product = Product::factory()->create(['unit_price' => 19.9]);

    expect($product->fresh()->unit_price)->toBe('19.90');
});
