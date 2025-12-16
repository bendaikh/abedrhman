<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'client_id',
        'type_service_id',
        'description',
        'date_service',
        'prix',
        'is_active',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prix' => 'decimal:2',
        'date_service' => 'date',
    ];

    /**
     * Get the client that owns this service
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the type of service
     */
    public function typeService(): BelongsTo
    {
        return $this->belongsTo(TypeService::class);
    }

    /**
     * Get the payments for this service
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the sous-services attached to this service
     */
    public function sousServices(): BelongsToMany
    {
        return $this->belongsToMany(SousService::class, 'service_sous_service')
            ->withTimestamps();
    }

    /**
     * Get the total of sous-services prices
     */
    public function getTotalSousServicesAttribute(): float
    {
        return $this->sousServices->sum('prix');
    }

    /**
     * Get the montant total (base price + sous-services)
     */
    public function getMontantTotalAttribute(): float
    {
        return $this->prix + $this->total_sous_services;
    }

    /**
     * Get formatted montant total
     */
    public function getFormattedMontantTotalAttribute(): string
    {
        return number_format($this->montant_total, 2, ',', ' ') . ' DH';
    }

    /**
     * Scope to get only active services
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPrixAttribute(): string
    {
        return number_format($this->prix, 2, ',', ' ') . ' DH';
    }

    /**
     * Get total payments made
     */
    public function getTotalPaymentsAttribute(): float
    {
        return $this->payments->sum('montant');
    }

    /**
     * Get formatted total payments
     */
    public function getFormattedTotalPaymentsAttribute(): string
    {
        return number_format($this->total_payments, 2, ',', ' ') . ' DH';
    }

    /**
     * Get remaining amount to pay (based on montant_total)
     */
    public function getRemainingAmountAttribute(): float
    {
        return max(0, $this->montant_total - $this->total_payments);
    }

    /**
     * Get formatted remaining amount
     */
    public function getFormattedRemainingAmountAttribute(): string
    {
        return number_format($this->remaining_amount, 2, ',', ' ') . ' DH';
    }

    /**
     * Check if fully paid
     */
    public function getIsFullyPaidAttribute(): bool
    {
        return $this->remaining_amount <= 0;
    }

    /**
     * Get payment progress percentage (based on montant_total)
     */
    public function getPaymentProgressAttribute(): int
    {
        if ($this->montant_total <= 0) return 100;
        return min(100, (int)(($this->total_payments / $this->montant_total) * 100));
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'initialiser' => 'Initialisé',
            'en_cours' => 'En cours',
            'termine' => 'Terminé',
            'annule' => 'Annulé',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get status color class
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'initialiser' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300',
            'en_cours' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300',
            'termine' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'annule' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300',
        ];
        return $colors[$this->status] ?? 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400';
    }
}


