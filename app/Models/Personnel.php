<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $table = 'personnel';

    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'date_naissance',
        'tel',
        'email',
        'adresse',
        'poste',
        'tache',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Generate a unique personnel number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'PER-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}




















