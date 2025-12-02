<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SousService extends Model
{
    protected $table = 'sous_services';
    
    protected $fillable = [
        'nom',
        'prix',
        'description',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prix' => 'decimal:2',
        'ordre' => 'integer',
    ];

    /**
     * Get the services that use this sous-service
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_sous_service')
            ->withTimestamps();
    }

    /**
     * Scope to get only active sous-services
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
        return number_format($this->prix, 2, ',', ' ') . ' DH';
    }
}

