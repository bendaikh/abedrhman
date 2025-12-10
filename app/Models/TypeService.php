<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeService extends Model
{
    protected $table = 'types_services';
    
    protected $fillable = [
        'nom',
        'code',
        'description',
        'prix',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordre' => 'integer',
        'prix' => 'decimal:2',
    ];

    /**
     * Get the offres for this type service
     */
    public function offres(): HasMany
    {
        return $this->hasMany(Offre::class, 'type_service_id');
    }

    /**
     * Get the services of this type
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'type_service_id');
    }

    /**
     * Scope to get only active types
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
     * Get formatted price
     */
    public function getFormattedPrixAttribute(): string
    {
        return number_format($this->prix ?? 0, 2, ',', ' ') . ' DH';
    }
}

