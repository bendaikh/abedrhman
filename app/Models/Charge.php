<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Charge extends Model
{
    protected $fillable = [
        'type_charge_id',
        'designation',
        'montant',
        'numero_recu_paiement',
        'observation',
        'date_charge',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_charge' => 'date',
    ];

    /**
     * Get the type charge that owns this charge
     */
    public function typeCharge(): BelongsTo
    {
        return $this->belongsTo(TypeCharge::class);
    }

    /**
     * Get formatted amount
     */
    public function getFormattedMontantAttribute(): string
    {
        return number_format($this->montant, 2, ',', ' ') . ' DH';
    }
}
