<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\VatCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
    'name',
    'description',
    'unit_price',
    'vat_category',
];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'vat_category' => VatCategory::class,
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
