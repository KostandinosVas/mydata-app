<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    // Μόνο ό,τι επιλέγει ο χρήστης. Αριθμό, status, σύνολα και ΜΑΡΚ τα βάζει ο κώδικας.
    protected $fillable = [
        'invoice_series_id',
        'customer_id',
        'payment_method',
    ];

    // Ένα νέο Invoice στη μνήμη ξεκινάει ως draft, πριν καν αποθηκευτεί.
    protected $attributes = [
        'status' => 'draft',
    ];

    protected function casts(): array
    {
        return [
            'invoice_type' => InvoiceType::class,
            'status' => InvoiceStatus::class,
            'payment_method' => PaymentMethod::class,
            'number' => 'integer',
            'branch' => 'integer',
            'issued_at' => 'date',
            'net_total' => 'decimal:2',
            'vat_total' => 'decimal:2',
            'gross_total' => 'decimal:2',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    // Το όνομα της μεθόδου (series) διαφέρει από τη στήλη, γι' αυτό τη δηλώνουμε ρητά.
    public function series(): BelongsTo
    {
        return $this->belongsTo(InvoiceSeries::class, 'invoice_series_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function correlatedInvoice(): BelongsTo
    {
        return $this->belongsTo(self::class, 'correlated_invoice_id');
    }
}
