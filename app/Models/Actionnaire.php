<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actionnaire extends Model
{
    protected $fillable = [
        'client_id',
        'intitule',
        'nom',
        'prenom',
        'part_sociale_pct',
        'type_piece_id',
        'n_piece_id',
        'piece_id',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'adresse',
        'ville',
        'pays',
        'tel1_resp',
        'tel2_resp',
        'email_resp',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'part_sociale_pct' => 'decimal:2',
    ];

    /**
     * Get the client that owns the actionnaire
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
