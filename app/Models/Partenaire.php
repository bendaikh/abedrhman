<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $table = 'partenaires';

    protected $fillable = [
        'raison_sociale',
        'responsable',
        'fonction',
        'activite',
        'tel',
        'email',
        'adresse',
        'ice',
        'rib',
    ];

    /**
     * Generate a unique partenaire number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'PAR-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}

