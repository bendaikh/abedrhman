<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    protected $fillable = [
        'numero',
        'service_id',
        'client_id',
        'montant_total',
        'montant_paye',
        'date_facture',
        'date_echeance',
        'statut',
        'notes',
    ];

    protected $casts = [
        'montant_total' => 'decimal:2',
        'montant_paye' => 'decimal:2',
        'date_facture' => 'date',
        'date_echeance' => 'date',
    ];

    /**
     * Get the service associated with this facture
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the client associated with this facture
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get formatted montant total
     */
    public function getFormattedMontantTotalAttribute(): string
    {
        return number_format($this->montant_total, 2, ',', ' ') . ' DH';
    }

    /**
     * Get formatted montant payé
     */
    public function getFormattedMontantPayeAttribute(): string
    {
        return number_format($this->montant_paye, 2, ',', ' ') . ' DH';
    }

    /**
     * Get remaining amount
     */
    public function getMontantRestantAttribute(): float
    {
        return max(0, $this->montant_total - $this->montant_paye);
    }

    /**
     * Get formatted remaining amount
     */
    public function getFormattedMontantRestantAttribute(): string
    {
        return number_format($this->montant_restant, 2, ',', ' ') . ' DH';
    }

    /**
     * Get status label
     */
    public function getStatutLabelAttribute(): string
    {
        $labels = [
            'brouillon' => 'Brouillon',
            'envoyee' => 'Envoyée',
            'payee' => 'Payée',
            'partielle' => 'Partiellement payée',
            'annulee' => 'Annulée',
        ];
        return $labels[$this->statut] ?? $this->statut;
    }

    /**
     * Get status color class
     */
    public function getStatutColorAttribute(): string
    {
        $colors = [
            'brouillon' => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400',
            'envoyee' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300',
            'payee' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'partielle' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300',
            'annulee' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300',
        ];
        return $colors[$this->statut] ?? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400';
    }

    /**
     * Generate next facture number
     */
    public static function generateNumero(): string
    {
        $year = date('Y');
        $lastFacture = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastFacture && preg_match('/FAC-' . $year . '-(\d+)/', $lastFacture->numero, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }
        
        return 'FAC-' . $year . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}

