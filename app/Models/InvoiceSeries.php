<?php

namespace App\Models;

use App\Enums\InvoiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_type',
        'code',
        'branch',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'invoice_type' => InvoiceType::class,
            'branch' => 'integer',
            'last_number' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
