<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TarificationCrea extends Model
{
    protected $table = 'tarifications_crea';
    
    protected $fillable = [
        'offre_crea_id',
        'type_tarification_id',
        'prix',
        'is_default',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'is_default' => 'boolean',
        'offre_crea_id' => 'integer',
        'type_tarification_id' => 'integer',
    ];

    /**
     * Get the offer for this tarification
     */
    public function offreCrea(): BelongsTo
    {
        return $this->belongsTo(OffreCrea::class, 'offre_crea_id');
    }

    /**
     * Get the type for this tarification
     */
    public function typeTarification(): BelongsTo
    {
        return $this->belongsTo(TypeTarification::class, 'type_tarification_id');
    }
}



