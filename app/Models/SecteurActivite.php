<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurActivite extends Model
{
    protected $fillable = [
        'nom',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope to get only active secteur activites
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('nom');
    }
}
