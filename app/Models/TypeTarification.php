<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeTarification extends Model
{
    protected $table = 'types_tarification';
    
    protected $fillable = [
        'nom',
        'code',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordre' => 'integer',
    ];

    /**
     * Get the tarifications for this type
     */
    public function tarifications(): HasMany
    {
        return $this->hasMany(TarificationDom::class, 'type_tarification_id');
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
}

