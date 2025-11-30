<?php

namespace App\Http\Controllers;

use App\Models\OffreDom;
use App\Models\OffreCrea;
use App\Models\TypeTarification;
use App\Models\TarificationDom;
use App\Models\TarificationCrea;
use App\Models\TypeService;
use App\Models\TypeActivite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{
    /**
     * Display the main parameters page
     */
    public function index()
    {
        $offresDom = OffreDom::ordered()->get();
        $offresCrea = OffreCrea::ordered()->get();
        $typesTarification = TypeTarification::ordered()->get();
        $tarificationsDom = TarificationDom::with(['offreDom', 'typeTarification'])->get();
        $tarificationsCrea = TarificationCrea::with(['offreCrea', 'typeTarification'])->get();

        return view('parametres.index', [
            'page_title' => 'Paramètres',
            'offresDom' => $offresDom,
            'offresCrea' => $offresCrea,
            'typesTarification' => $typesTarification,
            'tarificationsDom' => $tarificationsDom,
            'tarificationsCrea' => $tarificationsCrea,
        ]);
    }

    /**
     * Display DOM offers management page
     */
    public function offresDom()
    {
        $offresDom = OffreDom::ordered()->get();
        
        return view('parametres.offres-dom', [
            'page_title' => 'Gestion des offres DOM',
            'offresDom' => $offresDom,
        ]);
    }

    /**
     * Store a new DOM offer
     */
    public function storeOffreDom(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'duree_mois' => 'required|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = OffreDom::max('ordre') + 1;

        OffreDom::create($validated);

        return redirect()->route('parametres.offres-dom')
            ->with('success', 'Offre DOM créée avec succès.');
    }

    /**
     * Update a DOM offer
     */
    public function updateOffreDom(Request $request, OffreDom $offreDom)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'duree_mois' => 'required|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $offreDom->update($validated);

        return redirect()->route('parametres.offres-dom')
            ->with('success', 'Offre DOM mise à jour avec succès.');
    }

    /**
     * Delete a DOM offer
     */
    public function destroyOffreDom(OffreDom $offreDom)
    {
        $offreDom->delete();

        return redirect()->route('parametres.offres-dom')
            ->with('success', 'Offre DOM supprimée avec succès.');
    }

    /**
     * Display tarification types management page
     */
    public function typesTarification()
    {
        $typesTarification = TypeTarification::ordered()->get();
        
        return view('parametres.types-tarification', [
            'page_title' => 'Types de tarification',
            'typesTarification' => $typesTarification,
        ]);
    }

    /**
     * Store a new tarification type
     */
    public function storeTypeTarification(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_tarification,code',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = TypeTarification::max('ordre') + 1;

        TypeTarification::create($validated);

        return redirect()->route('parametres.types-tarification')
            ->with('success', 'Type de tarification créé avec succès.');
    }

    /**
     * Update a tarification type
     */
    public function updateTypeTarification(Request $request, TypeTarification $typeTarification)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_tarification,code,' . $typeTarification->id,
        ]);

        $validated['is_active'] = $request->has('is_active');

        $typeTarification->update($validated);

        return redirect()->route('parametres.types-tarification')
            ->with('success', 'Type de tarification mis à jour avec succès.');
    }

    /**
     * Delete a tarification type
     */
    public function destroyTypeTarification(TypeTarification $typeTarification)
    {
        $typeTarification->delete();

        return redirect()->route('parametres.types-tarification')
            ->with('success', 'Type de tarification supprimé avec succès.');
    }

    /**
     * Display tarification grid management page
     */
    public function tarificationsDom()
    {
        $offresDom = OffreDom::active()->ordered()->get();
        $typesTarification = TypeTarification::active()->ordered()->get();
        
        // Build a matrix of tarifications
        $tarificationsMatrix = [];
        foreach ($offresDom as $offre) {
            $tarificationsMatrix[$offre->id] = [];
            foreach ($typesTarification as $type) {
                $tarification = TarificationDom::where('offre_dom_id', $offre->id)
                    ->where('type_tarification_id', $type->id)
                    ->first();
                $tarificationsMatrix[$offre->id][$type->id] = $tarification ? $tarification->prix : null;
            }
        }
        
        return view('parametres.tarifications-dom', [
            'page_title' => 'Tarification DOM',
            'offresDom' => $offresDom,
            'typesTarification' => $typesTarification,
            'tarificationsMatrix' => $tarificationsMatrix,
        ]);
    }

    /**
     * Update all tarifications in grid
     */
    public function updateTarificationsDom(Request $request)
    {
        $tarifications = $request->input('tarifications', []);

        DB::transaction(function () use ($tarifications) {
            foreach ($tarifications as $offreId => $types) {
                foreach ($types as $typeId => $prix) {
                    if ($prix !== null && $prix !== '') {
                        TarificationDom::updateOrCreate(
                            [
                                'offre_dom_id' => $offreId,
                                'type_tarification_id' => $typeId,
                            ],
                            [
                                'prix' => floatval($prix),
                            ]
                        );
                    } else {
                        // Remove the tarification if price is empty
                        TarificationDom::where('offre_dom_id', $offreId)
                            ->where('type_tarification_id', $typeId)
                            ->delete();
                    }
                }
            }
        });

        return redirect()->route('parametres.tarifications-dom')
            ->with('success', 'Tarifications mises à jour avec succès.');
    }

    // ==================== CREA Methods ====================

    /**
     * Display CREA offers management page
     */
    public function offresCrea()
    {
        $offresCrea = OffreCrea::ordered()->get();
        
        return view('parametres.offres-crea', [
            'page_title' => 'Gestion des offres CREA',
            'offresCrea' => $offresCrea,
        ]);
    }

    /**
     * Store a new CREA offer
     */
    public function storeOffreCrea(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = OffreCrea::max('ordre') + 1;

        OffreCrea::create($validated);

        return redirect()->route('parametres.offres-crea')
            ->with('success', 'Offre CREA créée avec succès.');
    }

    /**
     * Update a CREA offer
     */
    public function updateOffreCrea(Request $request, OffreCrea $offreCrea)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $offreCrea->update($validated);

        return redirect()->route('parametres.offres-crea')
            ->with('success', 'Offre CREA mise à jour avec succès.');
    }

    /**
     * Delete a CREA offer
     */
    public function destroyOffreCrea(OffreCrea $offreCrea)
    {
        $offreCrea->delete();

        return redirect()->route('parametres.offres-crea')
            ->with('success', 'Offre CREA supprimée avec succès.');
    }

    /**
     * Display CREA tarification grid management page
     */
    public function tarificationsCrea()
    {
        $offresCrea = OffreCrea::active()->ordered()->get();
        $typesTarification = TypeTarification::active()->ordered()->get();
        
        // Build a matrix of tarifications
        $tarificationsMatrix = [];
        foreach ($offresCrea as $offre) {
            $tarificationsMatrix[$offre->id] = [];
            foreach ($typesTarification as $type) {
                $tarification = TarificationCrea::where('offre_crea_id', $offre->id)
                    ->where('type_tarification_id', $type->id)
                    ->first();
                $tarificationsMatrix[$offre->id][$type->id] = $tarification ? $tarification->prix : null;
            }
        }
        
        return view('parametres.tarifications-crea', [
            'page_title' => 'Tarification CREA',
            'offresCrea' => $offresCrea,
            'typesTarification' => $typesTarification,
            'tarificationsMatrix' => $tarificationsMatrix,
        ]);
    }

    /**
     * Update all CREA tarifications in grid
     */
    public function updateTarificationsCrea(Request $request)
    {
        $tarifications = $request->input('tarifications', []);

        DB::transaction(function () use ($tarifications) {
            foreach ($tarifications as $offreId => $types) {
                foreach ($types as $typeId => $prix) {
                    if ($prix !== null && $prix !== '') {
                        TarificationCrea::updateOrCreate(
                            [
                                'offre_crea_id' => $offreId,
                                'type_tarification_id' => $typeId,
                            ],
                            [
                                'prix' => floatval($prix),
                            ]
                        );
                    } else {
                        // Remove the tarification if price is empty
                        TarificationCrea::where('offre_crea_id', $offreId)
                            ->where('type_tarification_id', $typeId)
                            ->delete();
                    }
                }
            }
        });

        return redirect()->route('parametres.tarifications-crea')
            ->with('success', 'Tarifications CREA mises à jour avec succès.');
    }

    // ==================== Types Services Methods ====================

    /**
     * Display types services management page
     */
    public function typesServices()
    {
        $typesServices = TypeService::ordered()->get();
        
        return view('parametres.types-services', [
            'page_title' => 'Types de services',
            'typesServices' => $typesServices,
        ]);
    }

    /**
     * Store a new type service
     */
    public function storeTypeService(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_services,code',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = TypeService::max('ordre') + 1;

        TypeService::create($validated);

        return redirect()->route('parametres.types-services')
            ->with('success', 'Type de service créé avec succès.');
    }

    /**
     * Update a type service
     */
    public function updateTypeService(Request $request, TypeService $typeService)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_services,code,' . $typeService->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $typeService->update($validated);

        return redirect()->route('parametres.types-services')
            ->with('success', 'Type de service mis à jour avec succès.');
    }

    /**
     * Delete a type service
     */
    public function destroyTypeService(TypeService $typeService)
    {
        $typeService->delete();

        return redirect()->route('parametres.types-services')
            ->with('success', 'Type de service supprimé avec succès.');
    }

    // ==================== Types Activites Methods ====================

    /**
     * Display types activites management page
     */
    public function typesActivites()
    {
        $typesActivites = TypeActivite::ordered()->get();
        
        return view('parametres.types-activites', [
            'page_title' => 'Types d\'activités',
            'typesActivites' => $typesActivites,
        ]);
    }

    /**
     * Store a new type activite
     */
    public function storeTypeActivite(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_activites,code',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = TypeActivite::max('ordre') + 1;

        TypeActivite::create($validated);

        return redirect()->route('parametres.types-activites')
            ->with('success', 'Type d\'activité créé avec succès.');
    }

    /**
     * Update a type activite
     */
    public function updateTypeActivite(Request $request, TypeActivite $typeActivite)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:types_activites,code,' . $typeActivite->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $typeActivite->update($validated);

        return redirect()->route('parametres.types-activites')
            ->with('success', 'Type d\'activité mis à jour avec succès.');
    }

    /**
     * Delete a type activite
     */
    public function destroyTypeActivite(TypeActivite $typeActivite)
    {
        $typeActivite->delete();

        return redirect()->route('parametres.types-activites')
            ->with('success', 'Type d\'activité supprimé avec succès.');
    }
}

