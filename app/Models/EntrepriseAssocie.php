<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrepriseAssocie extends Model
{
    protected $fillable = [
        'entreprise_setting_id',
        'nom',
        'prenom',
        'cin',
        'parts_sociales',
        'pourcentage',
        'telephone',
        'email',
    ];

    protected $casts = [
        'parts_sociales' => 'decimal:2',
        'pourcentage' => 'decimal:2',
    ];

    /**
     * Get the entreprise setting that owns the associe
     */
    public function entrepriseSetting()
    {
        return $this->belongsTo(EntrepriseSetting::class);
    }
}

