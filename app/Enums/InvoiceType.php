<?php

namespace App\Enums;

enum InvoiceType: string
{
    case SalesInvoice = '1.1';
    case ServiceInvoice = '2.1';
    case CreditNoteCorrelated = '5.1';
    case CreditNoteUncorrelated = '5.2';
    case RetailReceipt = '11.1';
    case ServiceReceipt = '11.2';

    public function label(): string
    {
        return match ($this) {
            self::SalesInvoice => 'Τιμολόγιο Πώλησης',
            self::ServiceInvoice => 'Τιμολόγιο Παροχής Υπηρεσιών',
            self::CreditNoteCorrelated => 'Πιστωτικό Τιμολόγιο (συσχετιζόμενο)',
            self::CreditNoteUncorrelated => 'Πιστωτικό Τιμολόγιο (μη συσχετιζόμενο)',
            self::RetailReceipt => 'Απόδειξη Λιανικής Πώλησης',
            self::ServiceReceipt => 'Απόδειξη Παροχής Υπηρεσιών',
        };
    }

    public function requiresCounterpart(): bool
    {
        return match ($this) {
            self::SalesInvoice,
            self::ServiceInvoice,
            self::CreditNoteCorrelated,
            self::CreditNoteUncorrelated => true,
            self::RetailReceipt,
            self::ServiceReceipt => false,
        };
    }
}
