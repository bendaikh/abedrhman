<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Generate client number if not provided
        $numClient = !empty($row['num_client']) ? $row['num_client'] : Client::generateClientNumber();
        
        return new Client([
            'num_client' => $numClient,
            'type' => $row['type'] ?? 'particulier',
            'nom' => $row['nom'] ?? null,
            'prenom' => $row['prenom'] ?? null,
            'fonction' => $row['fonction'] ?? null,
            'type_piece_id' => $row['type_piece_id'] ?? null,
            'date_naissance' => !empty($row['date_naissance']) ? $row['date_naissance'] : null,
            'lieu_naissance' => $row['lieu_naissance'] ?? null,
            'nationalite' => $row['nationalite'] ?? null,
            'nom_raison_sociale' => $row['nom_raison_sociale'] ?? null,
            'sigle' => $row['sigle'] ?? null,
            'intitule' => $row['intitule'] ?? null,
            'forme_juridique' => $row['forme_juridique'] ?? null,
            'piece_justificative' => $row['piece_justificative'] ?? null,
            'numero_piece' => $row['numero_piece'] ?? null,
            'date_creation' => !empty($row['date_creation']) ? $row['date_creation'] : null,
            'forme_juridique_creee' => $row['forme_juridique_creee'] ?? null,
            'siege_social' => $row['siege_social'] ?? null,
            'ville' => $row['ville'] ?? null,
            'pays' => $row['pays'] ?? null,
            'secteur_activite' => $row['secteur_activite'] ?? null,
            'activite' => $row['activite'] ?? null,
            'autre_adresse_activite' => $row['autre_adresse_activite'] ?? null,
            'adresse_depot_magasin' => $row['adresse_depot_magasin'] ?? null,
            'tel_1' => $row['tel_1'] ?? null,
            'tel_2' => $row['tel_2'] ?? null,
            'fixe' => $row['fixe'] ?? null,
            'email' => $row['email'] ?? null,
            'observations' => $row['observations'] ?? null,
        ]);
    }

    /**
     * Validation rules for each row
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:particulier,societe',
            'email' => 'nullable|email',
        ];
    }
}
