<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::all();
    }

    /**
     * Define the headings for the Excel export
     */
    public function headings(): array
    {
        return [
            'num_client',
            'type',
            'nom',
            'prenom',
            'fonction',
            'type_piece_id',
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
        ];
    }

    /**
     * Map each client to the export format
     */
    public function map($client): array
    {
        return [
            $client->num_client,
            $client->type,
            $client->nom,
            $client->prenom,
            $client->fonction,
            $client->type_piece_id,
            $client->date_naissance ? $client->date_naissance->format('Y-m-d') : null,
            $client->lieu_naissance,
            $client->nationalite,
            $client->nom_raison_sociale,
            $client->sigle,
            $client->intitule,
            $client->forme_juridique,
            $client->piece_justificative,
            $client->numero_piece,
            $client->ice,
            $client->id_fiscale,
            $client->patente,
            $client->date_creation ? $client->date_creation->format('Y-m-d') : null,
            $client->forme_juridique_creee,
            $client->siege_social,
            $client->ville,
            $client->pays,
            $client->secteur_activite,
            $client->activite,
            $client->autre_adresse_activite,
            $client->adresse_depot_magasin,
            $client->tel_1,
            $client->tel_2,
            $client->fixe,
            $client->email,
            $client->observations,
        ];
    }
}
