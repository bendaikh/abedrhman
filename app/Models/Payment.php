<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'service_id',
        'montant',
        'type',
        'mode_paiement',
        'reference',
        'numero_transaction',
        'date_emission',
        'date_echeance',
        'encaisse',
        'numero_recu',
        'commentaire',
        'date_paiement',
        'notes',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'date',
        'date_emission' => 'date',
        'date_echeance' => 'date',
        'encaisse' => 'boolean',
    ];

    /**
     * Get the service that owns the payment
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get formatted amount
     */
    public function getFormattedMontantAttribute(): string
    {
        return number_format($this->montant, 2, ',', ' ') . ' DH';
    }

    /**
     * Get type label
     */
    public function getTypeLabelAttribute(): string
    {
        $labels = [
            'avance' => 'Avance',
            'paiement' => 'Paiement',
            'solde' => 'Solde',
        ];
        return $labels[$this->type] ?? $this->type;
    }

    /**
     * Get payment mode label
     */
    public function getModePaiementLabelAttribute(): string
    {
        $labels = [
            'especes' => 'Espèces',
            'cheque' => 'Chèque',
            'virement' => 'Virement',
            'carte' => 'Carte bancaire',
            'lcn' => 'LCN (traite)',
        ];
        return $labels[$this->mode_paiement] ?? $this->mode_paiement;
    }

    /**
     * Get encaisse label
     */
    public function getEncaisseLabelAttribute(): string
    {
        return $this->encaisse ? 'Oui' : 'Non';
    }
}
