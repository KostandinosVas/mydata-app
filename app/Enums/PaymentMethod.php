<?php

namespace App\Enums;

enum PaymentMethod: int
{
    case BankTransfer = 1;
    case Cash = 3;
    case OnCredit = 5;
    case Pos = 7;

    public function label(): string
    {
        return match ($this) {
            self::BankTransfer => 'Κατάθεση σε τράπεζα',
            self::Cash => 'Μετρητά',
            self::OnCredit => 'Επί πιστώσει',
            self::Pos => 'POS',
        };
    }
}
