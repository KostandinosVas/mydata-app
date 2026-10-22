<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('a company has many users', function () {
    $company = Company::factory()->create();
    $user = User::factory()->create();

    $user->company()->associate($company);
    $user->save();

    expect($company->users)->toHaveCount(1)
        ->and($company->users->first()->is($user))->toBeTrue();
});

test('the AADE subscription key is encrypted in the database and hidden from output', function () {
    $company = Company::factory()->create(['aade_subscription_key' => 'secret-key']);

    $rawValue = DB::table('companies')->where('id', $company->id)->value('aade_subscription_key');

    expect($rawValue)->not->toBe('secret-key')
        ->and($company->fresh()->aade_subscription_key)->toBe('secret-key')
        ->and($company->toArray())->not->toHaveKey('aade_subscription_key');
});
