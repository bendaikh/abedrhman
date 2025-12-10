<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    protected $table = 'offres';
    
    protected $fillable = [
        'type_service_id',
        'nom',
        'description',
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
     * Get the type service that owns this offre
     */
    public function typeService(): BelongsTo
    {
        return $this->belongsTo(TypeService::class, 'type_service_id');
    }

    /**
     * Get the tarifications for this offre
     */
    public function tarifications(): HasMany
    {
        return $this->hasMany(Tarification::class, 'offre_id');
    }

    /**
     * Scope to get only active offres
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

    /**
     * Scope to filter by type service
     */
    public function scopeForTypeService($query, $typeServiceId)
    {
        return $query->where('type_service_id', $typeServiceId);
    }
}

