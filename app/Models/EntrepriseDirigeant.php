<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrepriseDirigeant extends Model
{
    protected $fillable = [
        'entreprise_setting_id',
        'nom',
        'prenom',
        'fonction',
        'cin',
        'telephone',
        'email',
        'is_representant_legal',
    ];

    protected $casts = [
        'is_representant_legal' => 'boolean',
    ];

    /**
     * Get the entreprise setting that owns the dirigeant
     */
    public function entrepriseSetting()
    {
        return $this->belongsTo(EntrepriseSetting::class);
    }
}

