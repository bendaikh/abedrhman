<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteAssocie extends Model
{
    protected $table = 'comptes_associes';

    protected $fillable = [
        'nom_prenom',
        'tel',
        'email',
        'rib',
    ];

    /**
     * Generate a unique compte associe number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'CAS-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}

