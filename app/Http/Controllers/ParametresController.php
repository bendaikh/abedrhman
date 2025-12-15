<?php

namespace App\Http\Controllers;

use App\Models\OffreDom;
use App\Models\OffreCrea;
use App\Models\TypeTarification;
use App\Models\TarificationDom;
use App\Models\TarificationCrea;
use App\Models\TypeService;
use App\Models\TypeActivite;
use App\Models\SecteurActivite;
use App\Models\SousService;
use App\Models\Rubrique;
use App\Models\TypeCharge;
use App\Models\EntrepriseSetting;
use App\Models\EntrepriseDirigeant;
use App\Models\EntrepriseAssocie;
use App\Models\Offre;
use App\Models\Tarification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametresController extends Controller
{
    /**
     * Display the main parameters page (Tarification)
     */
    public function index(Request $request)
    {
        $typesServices = TypeService::with(['offres.tarifications.typeTarification'])->active()->ordered()->get();
        $typesTarification = TypeTarification::active()->ordered()->get();
        $sousServices = SousService::ordered()->get();
        
        // Get selected type service (from query param or first one)
        $selectedTypeServiceId = $request->get('type_service');
        if ($selectedTypeServiceId) {
            $selectedTypeService = $typesServices->firstWhere('id', $selectedTypeServiceId);
            if ($selectedTypeService) {
                // Reorder to put selected first
                $typesServices = $typesServices->sortBy(function($item) use ($selectedTypeServiceId) {
                    return $item->id == $selectedTypeServiceId ? 0 : 1;
                })->values();
            }
        }
        
        // Legacy data for backward compatibility
        $offresDom = OffreDom::ordered()->get();
        $offresCrea = OffreCrea::ordered()->get();
        $tarificationsDom = TarificationDom::with(['offreDom', 'typeTarification'])->get();
        $tarificationsCrea = TarificationCrea::with(['offreCrea', 'typeTarification'])->get();

        return view('parametres.index', [
            'page_title' => 'Tarification',
            'typesServices' => $typesServices,
            'typesTarification' => $typesTarification,
            'sousServices' => $sousServices,
            'selectedTypeServiceId' => $selectedTypeServiceId,
            // Legacy
            'offresDom' => $offresDom,
            'offresCrea' => $offresCrea,
            'tarificationsDom' => $tarificationsDom,
            'tarificationsCrea' => $tarificationsCrea,
        ]);
    }

    /**
     * Get offres for a specific type service (AJAX)
     */
    public function getOffresForTypeService(TypeService $typeService)
    {
        $offres = $typeService->offres()->active()->ordered()->get();
        $typesTarification = TypeTarification::active()->ordered()->get();
        
        // Build tarifications matrix
        $tarificationsMatrix = [];
        foreach ($offres as $offre) {
            $tarificationsMatrix[$offre->id] = [];
            foreach ($typesTarification as $type) {
                $tarification = Tarification::where('offre_id', $offre->id)
                    ->where('type_tarification_id', $type->id)
                    ->first();
                $tarificationsMatrix[$offre->id][$type->id] = $tarification ? $tarification->prix : null;
            }
        }

        return response()->json([
            'offres' => $offres,
            'typesTarification' => $typesTarification,
            'tarificationsMatrix' => $tarificationsMatrix,
        ]);
    }

    /**
     * Store a new offre for a type service
     */
    public function storeOffre(Request $request)
    {
        $validated = $request->validate([
            'type_service_id' => 'required|exists:types_services,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'duree_mois' => 'nullable|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = Offre::where('type_service_id', $validated['type_service_id'])->max('ordre') + 1;

        Offre::create($validated);

        return redirect()->route('parametres.index')
            ->with('success', 'Offre créée avec succès.');
    }

    /**
     * Update an offre
     */
    public function updateOffre(Request $request, Offre $offre)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'duree_mois' => 'nullable|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $offre->update($validated);

        return redirect()->route('parametres.index')
            ->with('success', 'Offre mise à jour avec succès.');
    }

    /**
     * Delete an offre
     */
    public function destroyOffre(Offre $offre)
    {
        $offre->delete();

        return redirect()->route('parametres.index')
            ->with('success', 'Offre supprimée avec succès.');
    }

    /**
     * Update tarifications for a type service
     */
    public function updateTarifications(Request $request, TypeService $typeService)
    {
        $tarifications = $request->input('tarifications', []);

        DB::transaction(function () use ($tarifications) {
            foreach ($tarifications as $offreId => $types) {
                foreach ($types as $typeId => $prix) {
                    if ($prix !== null && $prix !== '') {
                        Tarification::updateOrCreate(
                            [
                                'offre_id' => $offreId,
                                'type_tarification_id' => $typeId,
                            ],
                            [
                                'prix' => floatval($prix),
                            ]
                        );
                    } else {
                        // Remove the tarification if price is empty
                        Tarification::where('offre_id', $offreId)
                            ->where('type_tarification_id', $typeId)
                            ->delete();
                    }
                }
            }
        });

        return redirect()->route('parametres.index')
            ->with('success', 'Tarifications mises à jour avec succès.');
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
            'prix' => 'nullable|numeric|min:0',
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
            'prix' => 'nullable|numeric|min:0',
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

    /**
     * Display secteur activites management page
     */
    public function secteurActivites()
    {
        $secteurActivites = SecteurActivite::ordered()->get();
        
        return view('parametres.secteur-activites', [
            'page_title' => 'Secteurs d\'activité',
            'secteurActivites' => $secteurActivites,
        ]);
    }

    /**
     * Store a new secteur activite
     */
    public function storeSecteurActivite(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = SecteurActivite::max('order') + 1;

        SecteurActivite::create($validated);

        return redirect()->route('parametres.secteur-activites')
            ->with('success', 'Secteur d\'activité créé avec succès.');
    }

    /**
     * Update a secteur activite
     */
    public function updateSecteurActivite(Request $request, SecteurActivite $secteurActivite)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $secteurActivite->update($validated);

        return redirect()->route('parametres.secteur-activites')
            ->with('success', 'Secteur d\'activité mis à jour avec succès.');
    }

    /**
     * Delete a secteur activite
     */
    public function destroySecteurActivite(SecteurActivite $secteurActivite)
    {
        $secteurActivite->delete();

        return redirect()->route('parametres.secteur-activites')
            ->with('success', 'Secteur d\'activité supprimé avec succès.');
    }

    // ==================== Sous-Services Methods ====================

    /**
     * Display sous-services management page
     */
    public function sousServices()
    {
        $sousServices = SousService::ordered()->get();
        
        return view('parametres.sous-services', [
            'page_title' => 'Sous-services',
            'sousServices' => $sousServices,
        ]);
    }

    /**
     * Store a new sous-service
     */
    public function storeSousService(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = SousService::max('ordre') + 1;

        SousService::create($validated);

        return redirect()->route('parametres.sous-services')
            ->with('success', 'Sous-service créé avec succès.');
    }

    /**
     * Update a sous-service
     */
    public function updateSousService(Request $request, SousService $sousService)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $sousService->update($validated);

        return redirect()->route('parametres.sous-services')
            ->with('success', 'Sous-service mis à jour avec succès.');
    }

    /**
     * Delete a sous-service
     */
    public function destroySousService(SousService $sousService)
    {
        $sousService->delete();

        return redirect()->route('parametres.sous-services')
            ->with('success', 'Sous-service supprimé avec succès.');
    }

    // ==================== Rubriques Methods ====================

    /**
     * Display rubriques management page
     */
    public function rubriques()
    {
        $rubriques = Rubrique::with('typeCharges')->ordered()->get();
        $typesCharge = TypeCharge::with('rubrique')->ordered()->get();
        
        return view('parametres.rubriques', [
            'page_title' => 'Rubriques & Types de charge',
            'rubriques' => $rubriques,
            'typesCharge' => $typesCharge,
        ]);
    }

    /**
     * Store a new rubrique
     */
    public function storeRubrique(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = Rubrique::max('ordre') + 1;

        Rubrique::create($validated);

        return redirect()->route('parametres.rubriques')
            ->with('success', 'Rubrique créée avec succès.');
    }

    /**
     * Update a rubrique
     */
    public function updateRubrique(Request $request, Rubrique $rubrique)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $rubrique->update($validated);

        return redirect()->route('parametres.rubriques')
            ->with('success', 'Rubrique mise à jour avec succès.');
    }

    /**
     * Delete a rubrique
     */
    public function destroyRubrique(Rubrique $rubrique)
    {
        $rubrique->delete();

        return redirect()->route('parametres.rubriques')
            ->with('success', 'Rubrique supprimée avec succès.');
    }

    // ==================== Types de Charge Methods ====================

    /**
     * Display types de charge management page
     */
    public function typesCharge()
    {
        $rubriques = Rubrique::active()->ordered()->get();
        $typesCharge = TypeCharge::with('rubrique')->ordered()->get();
        
        return view('parametres.types-charge', [
            'page_title' => 'Types de charge',
            'rubriques' => $rubriques,
            'typesCharge' => $typesCharge,
        ]);
    }

    /**
     * Store a new type charge
     */
    public function storeTypeCharge(Request $request)
    {
        $validated = $request->validate([
            'rubrique_id' => 'nullable|exists:rubriques,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['ordre'] = TypeCharge::max('ordre') + 1;
        $validated['rubrique_id'] = $request->rubrique_id ?: null;

        TypeCharge::create($validated);

        return redirect()->route('parametres.rubriques', ['#types-charge'])
            ->with('success', 'Type de charge créé avec succès.');
    }

    /**
     * Update a type charge
     */
    public function updateTypeCharge(Request $request, TypeCharge $typeCharge)
    {
        $validated = $request->validate([
            'rubrique_id' => 'nullable|exists:rubriques,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['rubrique_id'] = $request->rubrique_id ?: null;

        $typeCharge->update($validated);

        return redirect()->route('parametres.rubriques', ['#types-charge'])
            ->with('success', 'Type de charge mis à jour avec succès.');
    }

    /**
     * Remove rubrique from a type charge
     */
    public function removeRubriqueFromTypeCharge(TypeCharge $typeCharge)
    {
        $typeCharge->update(['rubrique_id' => null]);

        return redirect()->route('parametres.rubriques', ['#types-charge'])
            ->with('success', 'Rubrique retirée du type de charge avec succès.');
    }

    /**
     * Delete a type charge
     */
    public function destroyTypeCharge(TypeCharge $typeCharge)
    {
        $typeCharge->delete();

        return redirect()->route('parametres.rubriques', ['#types-charge'])
            ->with('success', 'Type de charge supprimé avec succès.');
    }

    // ==================== Réglages de l'entreprise Methods ====================

    /**
     * Display company settings page
     */
    public function reglagesEntreprise()
    {
        $settings = EntrepriseSetting::getSettings();
        $settings->load(['dirigeants', 'associes']);
        
        return view('parametres.reglages-entreprise', [
            'page_title' => 'Réglages de l\'entreprise',
            'settings' => $settings,
        ]);
    }

    /**
     * Update company settings
     */
    public function updateReglagesEntreprise(Request $request)
    {
        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'sigle' => 'nullable|string|max:50',
            'forme_juridique' => 'nullable|string|max:100',
            'capital_social' => 'nullable|string|max:100',
            'ice' => 'nullable|string|max:50',
            'id_fiscale' => 'nullable|string|max:50',
            'patente' => 'nullable|string|max:50',
            'rc' => 'nullable|string|max:50',
            'cnss' => 'nullable|string|max:50',
            'date_creation' => 'nullable|date',
            'siege_social' => 'nullable|string|max:1000',
            'ville' => 'nullable|string|max:100',
            'pays' => 'nullable|string|max:100',
            'tel_1' => 'nullable|string|max:20',
            'tel_2' => 'nullable|string|max:20',
            'fixe' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'site_web' => 'nullable|string|max:255',
            'secteur_activite' => 'nullable|string|max:100',
            'activite_principale' => 'nullable|string|max:1000',
        ]);

        $settings = EntrepriseSetting::getSettings();
        $settings->update($validated);

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Informations de l\'entreprise mises à jour avec succès.');
    }

    /**
     * Store a new dirigeant for the company
     */
    public function storeDirigeant(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $settings = EntrepriseSetting::getSettings();
        $validated['entreprise_setting_id'] = $settings->id;
        $validated['is_representant_legal'] = $request->has('is_representant_legal');

        EntrepriseDirigeant::create($validated);

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Dirigeant ajouté avec succès.');
    }

    /**
     * Update a dirigeant
     */
    public function updateDirigeant(Request $request, EntrepriseDirigeant $dirigeant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $validated['is_representant_legal'] = $request->has('is_representant_legal');
        $dirigeant->update($validated);

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Dirigeant mis à jour avec succès.');
    }

    /**
     * Delete a dirigeant
     */
    public function destroyDirigeant(EntrepriseDirigeant $dirigeant)
    {
        $dirigeant->delete();

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Dirigeant supprimé avec succès.');
    }

    /**
     * Store a new associe for the company
     */
    public function storeAssocie(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
            'parts_sociales' => 'nullable|numeric|min:0',
            'pourcentage' => 'nullable|numeric|min:0|max:100',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $settings = EntrepriseSetting::getSettings();
        $validated['entreprise_setting_id'] = $settings->id;

        EntrepriseAssocie::create($validated);

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Associé ajouté avec succès.');
    }

    /**
     * Update an associe
     */
    public function updateAssocie(Request $request, EntrepriseAssocie $associe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
            'parts_sociales' => 'nullable|numeric|min:0',
            'pourcentage' => 'nullable|numeric|min:0|max:100',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $associe->update($validated);

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Associé mis à jour avec succès.');
    }

    /**
     * Delete an associe
     */
    public function destroyAssocie(EntrepriseAssocie $associe)
    {
        $associe->delete();

        return redirect()->route('parametres.reglages-entreprise')
            ->with('success', 'Associé supprimé avec succès.');
    }
}

