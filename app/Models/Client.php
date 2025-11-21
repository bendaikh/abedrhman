<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'num_client',
        'type',
        'nom',
        'prenom',
        'fonction',
        'type_piece_id',
        'n_piece_id',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'nom_raison_sociale',
        'sigle',
        'intitule',
        'forme_juridique',
        'piece_justificative',
        'numero_piece',
        'ice',
        'id_fiscale',
        'patente',
        'date_creation',
        'forme_juridique_creee',
        'siege_social',
        'ville',
        'pays',
        'secteur_activite',
        'activite',
        'autre_adresse_activite',
        'adresse_depot_magasin',
        'tel_1',
        'tel_2',
        'fixe',
        'email',
        'observations',
        'source',
        'intitule_source',
        'intitule_source_data',
    ];

    protected $casts = [
        'date_creation' => 'date',
        'date_naissance' => 'date',
    ];

    /**
     * Generate a unique client number
     */
    public static function generateClientNumber(): string
    {
        $lastClient = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastClient ? $lastClient->id + 1 : 1;
        return 'CLI-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
