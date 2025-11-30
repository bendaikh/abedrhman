<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeActivite extends Model
{
    protected $table = 'types_activites';
    
    protected $fillable = [
        'nom',
        'code',
        'description',
        'is_active',
        'ordre',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ordre' => 'integer',
    ];

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

