<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'nom',
        'type_service_id',
        'description',
        'prix',
        'duree',
        'unite_duree',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prix' => 'decimal:2',
    ];

    /**
     * Get the type of service
     */
    public function typeService(): BelongsTo
    {
        return $this->belongsTo(TypeService::class);
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
     * Get formatted duration
     */
    public function getFormattedDureeAttribute(): string
    {
        if (!$this->duree) return '-';
        
        $unites = [
            'heure' => 'heure(s)',
            'jour' => 'jour(s)',
            'semaine' => 'semaine(s)',
            'mois' => 'mois',
            'annee' => 'année(s)',
        ];
        
        $unite = $unites[$this->unite_duree] ?? $this->unite_duree;
        return $this->duree . ' ' . $unite;
    }
}

