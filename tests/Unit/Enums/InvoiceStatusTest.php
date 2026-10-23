<?php

use App\Enums\InvoiceStatus;

test('a draft can be issued but not cancelled', function () {
    expect(InvoiceStatus::Draft->canTransitionTo(InvoiceStatus::Issued))->toBeTrue()
        ->and(InvoiceStatus::Draft->canTransitionTo(InvoiceStatus::Cancelled))->toBeFalse();
});

test('a failed transmission can be retried', function () {
    expect(InvoiceStatus::Failed->canTransitionTo(InvoiceStatus::Sending))->toBeTrue();
});

test('a cancelled invoice is final', function () {
    expect(InvoiceStatus::Cancelled->allowedTransitions())->toBeEmpty();
});
