<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OffreDom;
use App\Models\TypeTarification;
use App\Models\TarificationDom;

class TarificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeds the default DOM offers and tarification from the screenshot
     */
    public function run(): void
    {
        // Create DOM offers
        $offresDom = [
            ['nom' => 'DOM 6 MOIS', 'duree_mois' => 6, 'ordre' => 1],
            ['nom' => 'DOM 1 ans', 'duree_mois' => 12, 'ordre' => 2],
            ['nom' => 'DOM 1 ans et 06 m', 'duree_mois' => 18, 'ordre' => 3],
            ['nom' => 'DOM 2 ans', 'duree_mois' => 24, 'ordre' => 4],
            ['nom' => 'DOM 2 ans et 06 m', 'duree_mois' => 30, 'ordre' => 5],
            ['nom' => 'DOM 3 ans', 'duree_mois' => 36, 'ordre' => 6],
        ];

        foreach ($offresDom as $offre) {
            OffreDom::updateOrCreate(
                ['nom' => $offre['nom']],
                $offre
            );
        }

        // Create tarification types
        $typesTarification = [
            ['nom' => 'Standard', 'code' => 'standard', 'ordre' => 1],
            ['nom' => 'Promotionnelle', 'code' => 'promotionnelle', 'ordre' => 2],
            ['nom' => 'Conventionnelle', 'code' => 'conventionnelle', 'ordre' => 3],
            ['nom' => 'Préférentielle', 'code' => 'preferentielle', 'ordre' => 4],
        ];

        foreach ($typesTarification as $type) {
            TypeTarification::updateOrCreate(
                ['code' => $type['code']],
                $type
            );
        }

        // Create tarification matrix (prices from the screenshot)
        // Format: [offre_nom => [type_code => prix]]
        $tarifications = [
            'DOM 6 MOIS' => [
                'standard' => 1500,
                'promotionnelle' => 1000,
                'conventionnelle' => 1001,
                'preferentielle' => 1200,
            ],
            'DOM 1 ans' => [
                'standard' => 3000,
                'promotionnelle' => 2000,
                'conventionnelle' => 2002,
                'preferentielle' => 2400,
            ],
            'DOM 1 ans et 06 m' => [
                'standard' => 4500,
                'promotionnelle' => 3000,
                'conventionnelle' => 3003,
                'preferentielle' => 3600,
            ],
            'DOM 2 ans' => [
                'standard' => 6000,
                'promotionnelle' => 4000,
                'conventionnelle' => 4004,
                'preferentielle' => 4800,
            ],
            'DOM 2 ans et 06 m' => [
                'standard' => 7500,
                'promotionnelle' => 5000,
                'conventionnelle' => 5005,
                'preferentielle' => 6000,
            ],
            'DOM 3 ans' => [
                'standard' => 9000,
                'promotionnelle' => 6000,
                'conventionnelle' => 6006,
                'preferentielle' => 7200,
            ],
        ];

        foreach ($tarifications as $offreNom => $types) {
            $offre = OffreDom::where('nom', $offreNom)->first();
            if ($offre) {
                foreach ($types as $typeCode => $prix) {
                    $type = TypeTarification::where('code', $typeCode)->first();
                    if ($type) {
                        TarificationDom::updateOrCreate(
                            [
                                'offre_dom_id' => $offre->id,
                                'type_tarification_id' => $type->id,
                            ],
                            ['prix' => $prix]
                        );
                    }
                }
            }
        }
    }
}

