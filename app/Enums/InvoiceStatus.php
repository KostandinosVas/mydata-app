<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case Draft = 'draft';
    case Issued = 'issued';
    case Sending = 'sending';
    case Transmitted = 'transmitted';
    case Failed = 'failed';
    case Cancelled = 'cancelled';

    /** @return list<self> Οι καταστάσεις στις οποίες επιτρέπεται να πάει από εδώ */
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Draft => [self::Issued],
            self::Issued => [self::Sending],
            self::Sending => [self::Transmitted, self::Failed],
            self::Failed => [self::Sending],
            self::Transmitted => [self::Cancelled],
            self::Cancelled => [],
        };
    }

    public function canTransitionTo(self $next): bool
    {
        return in_array($next, $this->allowedTransitions(), true);
    }
}
