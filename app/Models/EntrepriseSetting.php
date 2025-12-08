<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrepriseSetting extends Model
{
    protected $fillable = [
        'raison_sociale',
        'sigle',
        'forme_juridique',
        'capital_social',
        'ice',
        'id_fiscale',
        'patente',
        'rc',
        'cnss',
        'date_creation',
        'siege_social',
        'ville',
        'pays',
        'tel_1',
        'tel_2',
        'fixe',
        'email',
        'site_web',
        'secteur_activite',
        'activite_principale',
        'logo_path',
    ];

    protected $casts = [
        'date_creation' => 'date',
    ];

    /**
     * Get the dirigeants for the entreprise
     */
    public function dirigeants()
    {
        return $this->hasMany(EntrepriseDirigeant::class);
    }

    /**
     * Get the associes for the entreprise
     */
    public function associes()
    {
        return $this->hasMany(EntrepriseAssocie::class);
    }

    /**
     * Get or create the singleton settings instance
     */
    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([]);
        }
        return $settings;
    }
}
