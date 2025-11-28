<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comptable extends Model
{
    protected $table = 'comptables';

    protected $fillable = [
        'raison_sociale',
        'responsable',
        'activite',
        'tel',
        'email',
        'adresse',
        'ice',
        'rib',
    ];

    /**
     * Generate a unique comptable number
     */
    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        return 'COM-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}

