<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bailleur extends Model
{
    protected $table = 'bailleurs';

    protected $fillable = [
        'raison_sociale',
        'responsable_nom',
        'responsable_prenom',
        'fonction',
        'activite',
        'tel',
        'email',
        'adresse',
        'ice',
        'rib',
    ];

    /**
     * Generate a unique bailleur number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'BAI-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
