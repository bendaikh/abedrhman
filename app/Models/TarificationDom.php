<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TarificationDom extends Model
{
    protected $table = 'tarifications_dom';
    
    protected $fillable = [
        'offre_dom_id',
        'type_tarification_id',
        'prix',
        'is_default',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'is_default' => 'boolean',
        'offre_dom_id' => 'integer',
        'type_tarification_id' => 'integer',
    ];

    /**
     * Get the offer for this tarification
     */
    public function offreDom(): BelongsTo
    {
        return $this->belongsTo(OffreDom::class, 'offre_dom_id');
    }

    /**
     * Get the type for this tarification
     */
    public function typeTarification(): BelongsTo
    {
        return $this->belongsTo(TypeTarification::class, 'type_tarification_id');
    }
}

