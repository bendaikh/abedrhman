<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OffreCrea extends Model
{
    protected $table = 'offres_crea';
    
    protected $fillable = [
        'nom',
        'description',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordre' => 'integer',
    ];

    /**
     * Get the tarifications for this offer
     */
    public function tarifications(): HasMany
    {
        return $this->hasMany(TarificationCrea::class, 'offre_crea_id');
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















