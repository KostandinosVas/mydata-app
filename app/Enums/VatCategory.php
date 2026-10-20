<?php

namespace App\Enums;

enum VatCategory: int
{
    case Vat24 = 1;
    case Vat13 = 2;
    case Vat6 = 3;
    case Exempt = 7;
    case NoVat = 8;

    public function rate(): int
    {
        return match ($this) {
            self::Vat24 => 24,
            self::Vat13 => 13,
            self::Vat6 => 6,
            self::Exempt, self::NoVat => 0,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Vat24 => 'ΦΠΑ 24%',
            self::Vat13 => 'ΦΠΑ 13%',
            self::Vat6 => 'ΦΠΑ 6%',
            self::Exempt => 'ΦΠΑ 0% (απαλλαγή)',
            self::NoVat => 'Χωρίς ΦΠΑ',
        };
    }
}
