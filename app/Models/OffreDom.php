<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OffreDom extends Model
{
    protected $table = 'offres_dom';
    
    protected $fillable = [
        'nom',
        'duree_mois',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duree_mois' => 'integer',
        'ordre' => 'integer',
    ];

    /**
     * Get the tarifications for this offer
     */
    public function tarifications(): HasMany
    {
        return $this->hasMany(TarificationDom::class, 'offre_dom_id');
    }

    /**
     * Scope to get only active offers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by ordre field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre');
    }
}

