<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activite extends Model
{
    protected $fillable = [
        'nom',
        'type_activite_id',
        'description',
        'date_debut',
        'date_fin',
        'lieu',
        'capacite',
        'prix',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prix' => 'decimal:2',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'capacite' => 'integer',
    ];

    /**
     * Get the type of activite
     */
    public function typeActivite(): BelongsTo
    {
        return $this->belongsTo(TypeActivite::class);
    }

    /**
     * Scope to get only active activites
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
        if (!$this->prix) return '-';
        return number_format($this->prix, 2, ',', ' ') . ' DH';
    }
}
















