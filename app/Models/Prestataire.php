<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    protected $table = 'prestataires';

    protected $fillable = [
        'raison_sociale',
        'responsable_nom',
        'responsable_prenom',
        'fonction',
        'specialite',
        'tel',
        'email',
        'adresse',
        'ice',
        'rib',
        'notes',
    ];

    /**
     * Generate a unique prestataire number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'PRES-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}

