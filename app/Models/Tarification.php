<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarification extends Model
{
    protected $table = 'tarifications';
    
    protected $fillable = [
        'offre_id',
        'type_tarification_id',
        'prix',
        'is_default',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'is_default' => 'boolean',
        'offre_id' => 'integer',
        'type_tarification_id' => 'integer',
    ];

    /**
     * Get the offre for this tarification
     */
    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class, 'offre_id');
    }

    /**
     * Get the type for this tarification
     */
    public function typeTarification(): BelongsTo
    {
        return $this->belongsTo(TypeTarification::class, 'type_tarification_id');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPrixAttribute(): string
    {
        return number_format($this->prix, 2, ',', ' ') . ' DH';
    }
}

