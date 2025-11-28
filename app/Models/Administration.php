<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $table = 'administrations';

    protected $fillable = [
        'raison_sociale',
        'responsable_nom',
        'responsable_prenom',
        'fonction',
        'tel',
        'email',
        'adresse',
    ];

    /**
     * Generate a unique administration number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'ADM-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
