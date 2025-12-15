<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dirigeant extends Model
{
    protected $fillable = [
        'client_id',
        'intitule',
        'nom',
        'prenom',
        'fonction',
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
    ];

    /**
     * Get the client that owns the dirigeant
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
