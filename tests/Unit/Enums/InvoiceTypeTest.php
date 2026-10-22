<?php

use App\Enums\InvoiceType;

test('B2B document types require a counterpart', function () {
    expect(InvoiceType::SalesInvoice->requiresCounterpart())->toBeTrue()
        ->and(InvoiceType::ServiceInvoice->requiresCounterpart())->toBeTrue()
        ->and(InvoiceType::CreditNoteCorrelated->requiresCounterpart())->toBeTrue()
        ->and(InvoiceType::CreditNoteUncorrelated->requiresCounterpart())->toBeTrue();
});

test('retail document types do not require a counterpart', function () {
    expect(InvoiceType::RetailReceipt->requiresCounterpart())->toBeFalse()
        ->and(InvoiceType::ServiceReceipt->requiresCounterpart())->toBeFalse();
});

test('an AADE code converts to the right type', function () {
    expect(InvoiceType::from('11.1'))->toBe(InvoiceType::RetailReceipt);
});
