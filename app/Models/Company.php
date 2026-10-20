<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
    'name',
    'vat_number',
    'tax_office',
    'street',
    'street_number',
    'postal_code',
    'city',
    'country',
    'aade_user_id',
    'aade_subscription_key',
    ];

    protected $hidden = [
        'aade_subscription_key',
    ];

    protected function casts(): array
    {
        return [
            'aade_subscription_key' => 'encrypted',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
